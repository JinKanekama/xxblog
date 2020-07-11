<?php
    App::uses('AppModel', 'Model');
    App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
    
    // app/Model/User.php
    class User extends AppModel {
        public $actsAs = array('SoftDelete');

        public $useTable = 'users';

        public $hasMany = array(
            'Post' => array(
                'foreignKey' => 'user_id'
            ),
            'Good' => array(
                'foreignKey' => 'send_user_id',
            ),
            'Icon' => array(
                'foreignKey'  => 'user_id',
            )
            
        );

        public $hasOne = array(
            'Profile' => array(
                'foreignKey' => 'user_id'
            )
        );

        public $validate = array(
            'username' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'A username is required'
                )
            ),
            'password' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'A password is required'
                )
            ),
            'role' => array(
                'valid' => array(
                    'rule' => array('inList', array('admin', 'author')),
                    'message' => 'Please enter a valid role',
                    'allowEmpty' => false
                )
            )
        );

        public function beforeSave($options = array()) {
            //パスワードのハッシュ化
            if (isset($this->data[$this->alias]['password'])) {
                $passwordHasher = new BlowfishPasswordHasher();
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
                );
            }
            return true;
        }

        //sns連携登録処理
        public function register($twitter_user){
            $user = $this->find('first', array('conditions' => array('token_key' => $twitter_user['token_key'])));
            //更新処理の設定
            if($user) {
                $twitter_user['id'] = $user['User']['id'];
                unset($twitter_user['username']);
            }
            
            $this->create();
            $this->save(Array("User" => $twitter_user));
        }

    }

?>