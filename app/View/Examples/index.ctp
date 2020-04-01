<?php echo $html->link('ついったーでログイン','/examples/twitter'); ?>
<?php echo $form->create('Example',array('controller' => 'examples','action' => 'login')); ?>
<?php echo $form->input('username'); ?>
<?php echo $form->input('password'); ?>
<?php echo $form->end('Login'); ?>