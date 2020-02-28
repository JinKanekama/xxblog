<!-- app/View/Users/login.ctp -->

<div class="users form">
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<h2>XXブログログイン</h2>
<?php 
echo '<div class="form-group">';
echo '<label for="FormControlTextarea1">お名前</label>';
echo $this->Form->input('username', array('div'=>false, 'label' => false,"class"=>"form-control", 'rows' => '1'));
echo '</div>';
echo '<div class="form-group">';
echo '<label for="FormControlPassword">パスワード</label>';
echo $this->Form->password('password', array( 'div'=>false, 'label' => false,'class'=>'form-control', 'rows' => '1'));
echo '</div>';
?>
<?php echo '<button type="submit" class="btn btn-primary">ログイン</button>'; ?>
</div>

<?php echo $this->Html->link('新規登録', array('controller' => 'users', 'action' => 'add') ); ?>