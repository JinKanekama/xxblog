<!-- app/View/Users/add.ctp -->
<?= $this->Html->css('register.css'); ?>
<?= $this->assign('title', '新規登録'); ?>
<div class="row">
<div class="col-md-2">
</div>
<div class="users form col-md-8">
<?= $this->Form->create('User'); ?>
<h2>新規登録</h2>
<?php 
echo '<div class="form-group">';
echo '<label for="FormControlUsername">お名前</label>';
echo $this->Form->input('username', array('div'=>false, 'label' => false,'class'=>'form-control', 'rows' => '1'));
echo '</div>';
echo '<div class="form-group">';
echo '<label for="FormControlPassword">パスワード</label>';
echo $this->Form->password('password', array( 'div'=>false, 'label' => false,'class'=>'form-control', 'rows' => '1'));
echo '</div>';
?>
<div class="button-wrapper">
<button type="submit" class="btn btn-primary w-50">登録</button>
</div>
<div class="button-wrapper">
    <i class="fab fa-twitter"></i>
    <?php echo $this->Html->link('Twitterでログイン', array('controller' => 'users', 'action' => 'twitter') ); ?>
</div>
</div>
<div class="col-md-2">
</div>
</div>