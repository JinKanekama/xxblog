<?php
    class GoodsController extends AppController {
        //sessionコンポーネントの読み込み
        public $components = array('Session');  

        public function ajaxGood() {
            if($this->request->is('ajax')){
                $this->autoRender = FALSE;
                $post_id = filter_input(INPUT_POST, "postId");
                $goods = filter_input(INPUT_POST, "goods");
                $goodFlag = filter_input(INPUT_POST, "goodFlag");
                $recieved_user_id = filter_input(INPUT_POST, "recievedUserId");
                $send_user_id = $this->Session->read('Auth.User.id');

                if ($goodFlag == 0) {
                    $this->request->data['send_user_id'] = $send_user_id;
                    $this->request->data['post_id'] = $post_id;
                    $this->request->data['recieved_user_id'] = $recieved_user_id;
                    if ($this->Good->save($this->request->data)) {
                        $goods++;
                        $goodFlag = 1;
                        $datas = array($goods, $goodFlag);
                        echo json_encode($datas);
                    } 
                } elseif ($goodFlag == 1) {
                    $condition = array(
                        'send_user_id' => $send_user_id,
                        'recieved_user_id' => $recieved_user_id,
                        'post_id' => $post_id
                    );
                    if($this->Good->deleteAll($condition, false)){
                        $goods--;
                        $goodFlag = 0;
                        $datas = array($goods, $goodFlag);
                        echo json_encode($datas);
                    }
                }
            }
        }
    }
?>