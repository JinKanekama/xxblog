<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */


$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<!-- fontawesome導入 -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"> 
	<link rel="icon" href="/img/xxblog-logo.png">
	<?php
		//echo $this->Html->meta('icon');
	
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('default');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->script('jquery-3.4.1.min.js');
		echo $this->Html->script('bootstrap.min.js');
	?>
</head>
<body>
  <div id="wrapper">
	<div id="container">
		<div id="header">
			<nav class="navbar navbar-expand-md navbar-dark" style="background-color:#428BCA;";>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav">
					</ul>
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<?php echo $this->Html->link('XXブログ', array('controller' => 'posts', 'action' => 'index', ), array('class' => 'nav-link')); ?>
						</li>
						<li class="nav-item">
							<a href="/posts/news/total" class="nav-link">ブログ速報</a>
						</li>
						<li class="nav-item">
							<a href="/posts/rankings/total" class="nav-link">ランキング</a>
						</li>
						<li class="nav-item">
							<?php echo $this->Html->link('カテゴリ', array('controller' => '', 'action' => '', ), array('class' => 'nav-link')); ?>
						</li>
						<?php
							$session = $this->Session->read('Auth.User.id');
							if (isset($session)){
								echo '<li class="nav-item">';
								echo $this->Html->link('MyPage', array('controller' => 'profiles', 'action' => 'mypage', ), array('class' => 'nav-link'));
								echo '</li>';
								echo '<li class="nav-item">';
								echo $this->Html->link('管理画面', array('controller' => 'imports', 'action' => 'index', ), array('class' => 'nav-link'));
								echo '</li>';
							} 
						?>
					</ul>
					<ul class="navbar-nav nav-right">
						<?php
							if (isset($session)){
								echo '<li class="nav-item">';
								echo $this->Html->link('ログアウト', array('controller' => 'users', 'action' => 'logout', ), array('class' => 'nav-link'));
								echo '</li>';
							} else {
								echo '<li class="nav-item">';
								echo $this->Html->link('ログイン', array('controller' => 'users', 'action' => 'login', ), array('class' => 'nav-link'));
								echo '</li>';
								echo '<li class="nav-item">';
								echo $this->Html->link('新規登録', array('controller' => 'users', 'action' => 'add', ), array('class' => 'nav-link'));
								echo '</li>';
							}
						?>
						<!-- 要修正！ -->
						<?php  if(isset($searchFlag)):?>
							<?php echo $this->Form->create('Post', array('url' => '/posts/searchBlogs', 'class'=>'form-inline')); ?>						
					
								<?php echo $this->Form->input('Post.word', array('div' => false, 'label' => false, 'id' => "sbox1", 'class'=>'form-control', 'rows' => '1'));?><!-- Post.titleのところを修正 -->
								<button type="submit" id="sbtn1" class="btn btn-outline-light">検索</button>
			
							<?php echo $this->Form->end(); ?>
						<?php endif;?>
					</ul>
				</div>
			</nav>
		</div>
		<div id="content">
			<?php echo $this->Flash->render('auth'); ?>
			<?php echo $this->Flash->render(); ?>
			<div class="container">
				<div class="row">
					<div class="col-md-1 container-items"></div>
					<div class="col-md-10 center">
						<?php echo $this->fetch('content'); ?>
					</div>
					<div class="col-md-1 container-items"></div>
				</div>
			</div>
		</div>
		<div id="footer">
			<nav class="navbar navbar-expand navbar-light" style="background-color:#C0C0C0;";>
				<ul class="navbar-nav  mr-auto">
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item">
						<?php echo $this->Html->link('お問い合わせ', array('controller' => 'contacts', 'action' => 'contactForm', ), array('class' => 'nav-link')); ?>
					</li> 
					<li class="nav-item">
						<?php echo $this->Html->link('利用規約', array('controller' => '', 'action' => '', ), array('class' => 'nav-link')); ?>
					</li> 
					<li class="nav-item">
						<?php echo $this->Html->link('ヘルプ', array('controller' => '', 'action' => '', ), array('class' => 'nav-link')); ?>
					</li> 
				</ul>
			</nav>
		</div>
  </div><!-- </div>end <wrapper> -->
</body>
</html>
