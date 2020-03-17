<?php
    class Icon extends AppModel {
        public $useTable = 'icons';

        public $actsAs = array(
            'Upload.Upload' => array(
              'name' => array(
                'fields' => array(
                  'dir' => 'icon_dir'
                ),
                'thumbnailSizes' => array(
                  'thumb' => '80x80',
                ),
              ),
            ),
          );
        
        public $belongsTo = array(
            'User' => array(
                'foreignKey' => 'user_id'    
            )
        );
    }
?>