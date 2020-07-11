<!-- app/View/Users/login.ctp -->
<?= $this->Html->css('register.css'); ?>
<?= $this->assign('title', 'ログイン'); ?>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="users form col-md-8">
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
        <div class="button-wrapper">
            <button type="submit" class="btn btn-primary w-50">ログイン</button>
        </div>
        <div class="button-wrapper">
            <?php echo $this->Html->link('新規会員登録', array('class' => 'register','controller' => 'users', 'action' => 'add') ); ?>
        </div>
        <div class="button-wrapper">
            <i class="fab fa-twitter"></i>
            <?php echo $this->Html->link('twitterでログイン', array('class' => 'register','controller' => 'users', 'action' => 'twitter') ); ?>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>