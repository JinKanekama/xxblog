<?php
    class ContactsController extends AppController {
        public function contactForm() {
            if ($this->request->is('post')) {
                $this->Contact->create();
                if ($this->Contact->saveMany($this->request->data)) {
                    $this->Flash->success(__('お問い合わせありがとうございます'));
                    return $this->redirect(array('controller' => 'posts','action' => 'index'));
                }  else {
                    $this->Flash->error(__('送信できませんでした'));
                }
            }
        }
    }
?>