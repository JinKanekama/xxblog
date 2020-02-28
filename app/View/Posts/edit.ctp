<!-- File: /app/View/Posts/edit.ctp -->
<h1>Edit Post</h1>
<?php
echo $this->Form->create('Post');
echo '<div class="form-group">';
echo '<label for="FormControlTile">タイトル</label>';
echo $this->Form->input('title', array('label' => false, 'class'=>'form-control', 'rows' => '1'));
echo '</div>';
echo '<div class="form-group">';
echo '<label for="FormControlBody">内容</label>';
echo $this->Form->input('body', array('label' => false, 'class'=>'form-control', 'rows' => '10'));
echo '</div>';
echo $this->Form->input('id', array('type' => 'hidden'));
echo '<button type="submit" class="btn btn-primary">保存</button>';
echo $this->Form->end();
?>