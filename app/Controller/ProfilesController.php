<?php
    class ProfilesController extends AppController {
        //sessionコンポーネントの読み込み
        public $components = array('Session');  
        public $uses = array('User', 'Icon');

         //承認機能
         public function isAuthorized($user) {
            return true;

            return parent::isAuthorized($user);
        }

        public function mypage(){
            $user_id = $this->Session->read('Auth.User.id');
            $this->User->recursive = 2;
            $user = $this->User->findById($user_id);
            $this->set('user', $user);
        }

        public function myIndex(){
            
        }

        public function edit(){
            $user_id = $this->Session->read('Auth.User.id');

            if (!$user_id) {
                throw new NotFoundException(__('Invalid post'));
            }
            $this->User->recursive = 2;
            $user = $this->User->findById($user_id);
            if (!$user) {
                throw new NotFoundException(__('Invalid post'));
            }

            $this->set('user', $user);

            //edit実行
            if ($this->request->is(array('post', 'put'))) {
                $this->User->id = $user_id;
                if ($this->User->saveAll($this->request->data, array('deep' => true))) {
                    $this->Flash->success(__('プロフィールを更新しました。'));
                    
                    return $this->redirect(array('action' => 'mypage'));
                }
                $this->Flash->error(__('プロフィールが更新できませんでした。'));
            }

            //edit画面のフォームに入る初期値設定
            if (!$this->request->data) {
                $this->request->data = $user;
            }
        }

        public function delete(){

        }
    }

?>