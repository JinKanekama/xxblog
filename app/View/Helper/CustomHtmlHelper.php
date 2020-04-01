<?php

App::uses('AppHelper', 'View/Helper');
App::import('Helper', 'Html');

class CustomHtmlHelper extends HtmlHelper {

    public function image($path, $options = array()) { // override

        // 画像のパスをパース(HtmlHelper::image()と同様)
        $realPath = $this->assetUrl($path, $options + array('pathPrefix' => Configure::read('App.imageBaseUrl')));

        // 同ホストの画像の場合のみ
        if (!preg_match('|(https?:)?//|',$realPath) && !file_exists(WWW_ROOT.$realPath)) {
            $path = 'noimage.png';
        }

        return parent::image($path, $options);
    }
}

