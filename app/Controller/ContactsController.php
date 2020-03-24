<?php
App::uses('CakeEmail', 'Network/Email');

    class ContactsController extends AppController {
        public function contactForm() {
            //test
            $email = new CakeEmail();
            $email->transport('Mail');

            $email->from('j_kanekama@funteam.co.jp');
            $email->to('j_kanekama@funteam.co.jp');

            $email->subject('これはテストメール');
            $massage = $email->send('これはテストメールの本文です');
            $this->set('massage', $massage);

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