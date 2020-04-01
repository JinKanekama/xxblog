<?php

    App::import('Vendor', 'OAuth/OAuthClient'); 

    class HogeController extends AppController {
        /**
         * _createConsumer
         */
        protected function _createConsumer()
        {
            return new OAuth_Consumer(
                'zv42kZ3sL0C6jmEddVZf0MXMQ',
                '7bx0kfVjgVjvpqnOnqAXk4KmXyAUW0cQpUUTVM6MSdetRG0mT0'
            );
        }

        /**
         * twitter
         * リダイレクトします
         */
        public function twitter()
        {
            $requestToken = $this->_createConsumer()->getRequestToken(
                'https://api.twitter.com/oauth/request_token',// エンドポイントとも言うんでしょうかね
                'http://xxblog.test/users/register'// 自分のサイトのユーザ登録用のURL...(a)
            );
            $this->Session->write('request_token', $requestToken);// セッションにリクエストトークンを保存
            $this->redirect('https://api.twitter.com/oauth/authorize?oauth_token=' . $requestToken->key);// twitter側にリダイレクト
        }

        /**
         * register
         * 登録
         */
        public function register()
        {
            $consumer = $this->_createConsumer();
            $token    = $consumer->getAccessToken(
                'https://api.twitter.com/oauth/access_token',
                $this->Session->read('request_token')
            );// セッションに保存してあるリクエストトークンをセットしてアクセストークンを要求
            if($token != ''){
                $twitter = $consumer->get(
                    $token->key,
                    $token->secret,
                    'http://twitter.com/account/verify_credentials.json',
                    array()
                );// twitter上におけるユーザの情報を取得（optional）
                $twitter = json_decode($twitter, true);
            
                // 登録 or 更新 (内部でどちらか判定して保存)...(b)
                $registeredId = $this->User->register(array(
                    'twitter_id'   => $twitter['id_str'],
                    'twitter_name' => $twitter['screen_name'],
                    'token_key'    => $token->key,// ユーザのトークン
                    'token_secret' => $token->secret,// ユーザのシークレット
                ));
            
                $user['User']["token_key"]    = $token->key;
                $user['User']["token_secret"] = $token->secret;
                $this->Auth->login($user);
            }
        }


    }