<?php
App::uses('CakeEmail', 'Network/Email');

    class ContactsController extends AppController {
        public function contactForm() {
            //test
            

            // $this->request->data['Contact']['name'];
            // $this->request->data['Contact']['email'];
            // $this->request->data['Contact']['content'];

            // $email->subject('これはテストメール');
            // $massage = $email->send(
            //     $this->request->data['Contact']['name'].
            //     $this->request->data['Contact']['email'].
            //     $this->request->data['Contact']['content']);

            // $this->set('massage', $massage);

            if ($this->request->is('post')) {
                $email = new CakeEmail();
                $email->transport('Mail');
                $email->to($this->request->data['Contact']['email']);
                $email->subject('お問い合わせ完了メール');
                $email->template('my_template');
                $ary_vars = array (
                    'name' => $this->request->data['Contact']['name'],
                    'msg'    => 'ありがとうございました。'
                );
                $email->viewVars($ary_vars);
                $email->emailFormat('text');
                $massage = $email->send();

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