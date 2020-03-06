<!-- File: /app/View/profiles/edit.ctp -->
<?= $this->assign('title', "編集画面"); ?>
<?php Debugger::dump($this->request->data ); ?>

<h1>プロフィール編集画面</h1>
<?php
echo $this->Form->create('User',  array('type' => 'file'));
echo '<div class="form-group">';
echo '<label for="imageUploada">アップロード</label>';
echo $this->Form->input('Icon.0.name', array('type' => 'file', 'label' => false)); 
echo $this->Form->input('Icon.0.model', array('type' => 'hidden', 'value' => 'Profile')); 
echo $this->Form->input('Icon.0.icon_dir', array('type' => 'hidden'));
echo $this->Form->input('Icon.0.id', array('type' => 'hidden'));
echo '</div>';
echo '<div class="form-group">';
echo '<label for="FormControlUsername">名前</label>';
echo $this->Form->input('username', array('label' => false, 'class'=>'form-control', 'rows' => '1'));
echo '</div>';
echo '<div class="form-group">';
echo '<label for="FormControlTitle">ブログタイトル</label>';
echo $this->Form->input('Profile.blog_title', array('label' => false, 'class'=>'form-control', 'rows' => '1'));
echo '</div>';
echo '<div class="form-group">';
echo '<label for="FormControlBody">自己紹介</label>';
echo $this->Form->input('Profile.body', array('label' => false, 'class'=>'form-control', 'rows' => '10'));
echo '</div>';
// 更新処理のためにidを指定
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('Profile.id', array('type' => 'hidden'));
echo '<button type="submit" class="btn btn-primary">保存</button>';
echo $this->Form->end();
?>