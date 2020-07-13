<?php
    // Oauthライブラリをimport
    App::import('Vendor', 'OAuth/OAuthClient');

    // app/Controller/UsersController.php
    App::uses('AppController', 'Controller');

    class UsersController extends AppController {

        public $components = array(
            'Session',
          );

        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('add', 'logout','twitter', 'callback', 'createClient', 'test');

        }

        public function index() {
            $this->User->recursive = 0;
            $this->paginate = array(
                'order' => array(
                    'User.id' => 'asc'
            ));
            $this->set('users', $this->paginate());
        }

        public function view($id = null) {
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            $this->set('user', $this->User->findById($id));
        }

        public function add() {
            if ($this->request->is('post')) {
                $this->request->data['User']['role'] = 'author';
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Flash->success(__('ユーザーを登録しました。'));
                    return $this->redirect(array('controller'=>'users', 'action' => 'login'));
                }
                $this->Flash->error(
                    __('ユーザーが登録できませんでした。')
                );
            }
        }

        public function edit($id = null) {
            $this->User->id = $id;
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->User->save($this->request->data)) {
                    $this->Flash->success(__('編集しました。'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Flash->error(
                    __('編集ができませんでした。')
                );
            } else {
                $this->request->data = $this->User->findById($id);
                unset($this->request->data['User']['password']);
            }
        }

        public function delete($id = null) {
            // Prior to 2.5 use
            // $this->request->onlyAllow('post');
            $user = $this->User->findById($id);
            $this->request->allowMethod('post');
            
            $this->User->id = $id;
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->User->delete($id)) {
                $this->Flash->success(__('ユーザーを削除しました。'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('ユーザーを削除できませんでした。'));
            return $this->redirect(array('action' => 'index'));
        }

        
        public function login() {
            $user = $this->User->find('first', array('conditions' => array('username' => '佐藤')));
            $this->Session->write('test', $user);
            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    $this->Flash->success(__('ログインしました'));
                    $this->redirect($this->Auth->Redirect());
                } else {
                    $this->Flash->error(__('ユーザー名またはパスワードが違います。'));
                }
            }
        }
        
        public function logout() {
            $this->Flash->error(__('ログアウトしました。'));
            $this->redirect($this->Auth->logout());
        }

        //twitter認証
        public function twitter() {
            $client = $this->createClient();
            //リクエストトークンの取得
            $requestToken = $client->getRequestToken(
                'https://api.twitter.com/oauth/request_token', 'http://xxblog.test/users/callback');
            if ($requestToken) {
              $this->Session->write('twitter_request_token', $requestToken);
              $this->redirect('https://api.twitter.com/oauth/authorize?oauth_token=' . $requestToken->key);
            } else {
              // an error occured when obtaining a request token
            }
        }


        public function callback() {
            $requestToken = $this->Session->read('twitter_request_token');
            $client = $this->createClient();
            //アクセストークンの取得
            $accessToken = $client->getAccessToken('https://api.twitter.com/oauth/access_token', $requestToken);

            if ($accessToken != "") {
              //$client->post($accessToken->key, $accessToken->secret, 'https://api.twitter.com/1.1/statuses/update.json', array('status' => 'hello'));
                //twitterの情報の取得
                $twitter = $client->get(
                            $accessToken->key,
                            $accessToken->secret,
                            'https://api.twitter.com/1.1/account/verify_credentials.json',
                            array()
                );
                $twitter = json_decode($twitter, true);
                $this->Session->write('twitter', $twitter);
                // 内部で登録か更新か判定して保存
                $user = array(
                'username' => $twitter['screen_name'],
                'password' => $accessToken->secret,
                'role' => 'author',
                'twitter_id'   => $twitter['id_str'],
                'twitter_name' => $twitter['screen_name'],
                'token_key'    => $accessToken->key,// ユーザのトークン
                'token_secret' => $accessToken->secret,// ユーザのシークレット
                'service' => 'twitter',
                );
                $this->User->register($user);

                $login_user = $this->User->find('first', array('conditions' => array('token_key' => $accessToken->key)));
                $this->Auth->login($login_user['User']);
                $this->redirect($this->Auth->Redirect());
            } else {
                //ユーザーがtwitterアカウントへのアクセスを許可しなかった場合、トップページへ遷移
                $this->redirect(array('controller'=>'posts', 'action'=>'index')) ;
            }
            exit;
        }

        private function createClient() {
            return new OAuthClient('zv42kZ3sL0C6jmEddVZf0MXMQ', '7bx0kfVjgVjvpqnOnqAXk4KmXyAUW0cQpUUTVM6MSdetRG0mT0');
        }
        
    }

    

?>