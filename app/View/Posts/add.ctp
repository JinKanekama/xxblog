<!-- File: /app/View/Posts/add.ctp -->  
<?= $this->assign('title', "記事投稿"); ?>
<?PHP echo $this->Html->css('addPost.css'); ?>

<h1>Add Post</h1>
<?php
echo $this->Form->create('Post', array('type' => 'file'));
echo '<div class="form-group">';
echo '<label for="FormControlTextareaName">カテゴリー</label>';
echo $this->Form->input('Category.id', 
    array('label' => false,
        'options' => $select,
        'class'=>'form-control'
        )
);
echo '</div>';
echo '<div class="form-group">';
echo '<label for="FormControlTextareaTile">タイトル</label>';
echo $this->Form->input('Post.title', array('label' => false, 'class'=>'form-control', 'rows' => '1'));
echo '</div>';
echo '<div class="form-group">';
echo '<label for="FormControlTextareaContent">内容</label>';
echo $this->Form->input('Post.body', array( 'label' => false,'class'=>'form-control form-body', 'rows' => '10'));
echo '</div>';
echo '<label for="FormControlTextareaTile">タグ</label>';
echo $this->Form->input('Tag.Tag', array( 
    'label' => false,
    'type' => 'select', 
    'multiple'=> 'checkbox',
    'options' =>  $check,
));

//画像アップローダ
echo '<div class="form-group">';
echo '<label for="imageUploada">アップロード</label>';
echo $this->Form->input('Image.0.name', array('type' => 'file', 'label' => false)); 
echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post')); 
echo $this->Form->input('Image.0.image_dir', array('type' => 'hidden'));
echo $this->Form->input('Image.1.name', array('type' => 'file', 'label' => false)); 
echo $this->Form->input('Image.1.model', array('type' => 'hidden', 'value' => 'Post')); 
echo $this->Form->input('Image.1.image_dir', array('type' => 'hidden'));
echo $this->Form->input('Image.2.name', array('type' => 'file', 'label' => false)); 
echo $this->Form->input('Image.2.model', array('type' => 'hidden', 'value' => 'Post')); 
echo $this->Form->input('Image.2.image_dir', array('type' => 'hidden'));
echo '<button type="submit" class="btn btn-primary">保存</button>';
echo '</div>';
echo $this->Form->end();
?>

