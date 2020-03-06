<!-- app/View/Users/add.ctp -->
<?= $this->Html->css('register.css'); ?>
<?= $this->assign('title', '新規登録'); ?>


<div class="users form">
<?php echo $this->Form->create('User'); ?>
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


    echo $this->Form->input('role', array(
        'options' => array('admin' => 'Admin', 'author' => 'Author')
    ));
    ?>
<?php echo '<button type="submit" class="btn btn-primary">登録</button>'; ?>
</div>

