<?php
    class Good extends AppModel {
        public $useTable = 'goods';

        public $belongsTo = array(
            'Post' => array(
                'foreignKey' => 'post_id'
            ),
            'User' => array(
                'foreignKey' => 'send_user_id'
            )
        );
    }
    
?>