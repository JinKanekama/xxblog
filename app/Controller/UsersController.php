<?php

    // app/Controller/UsersController.php
    App::uses('AppController', 'Controller');

    class UsersController extends AppController {

        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('add', 'logout');
        }

        public function index() {
            $this->User->recursive = 0;
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
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Flash->success(__('ユーザーを登録しました。'));
                    return $this->redirect(array('action' => 'index'));
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

            $this->request->allowMethod('post');

            $this->User->id = $id;
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->User->delete()) {
                $this->Flash->success(__('ユーザーを削除しました。'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('ユーザーを削除できませんでした。'));
            return $this->redirect(array('action' => 'index'));
        }

        
        public function login() {
            
            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
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

    }

    

?>