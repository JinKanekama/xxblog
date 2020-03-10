<?= $this->assign('title', $user['User']['username'].'さんのページ') ; ?>
<?PHP echo $this->Html->css('mypage.css'); ?>

<?php if (isset($user['Profile']['blog_title'])):?>
<h1><?= h($user['Profile']['blog_title']) ?></h1>
<?php else: ?>
<h1>XX</h1>
<?php endif?>

<div class="row">
<div class="icon-content col-3">
    <?php if (isset($user['Icon'][0])):?>
    <?php $icon_sorce = '/files/icon/name/'.$user['Icon'][0]['icon_dir'].'/thumb_'.$user['Icon'][0]['name'] ?>
    <?=  $this->CustomHtml->image($icon_sorce, array('class'=>'rounded')) ?>
    <?php else:?>
    <?=  $this->CustomHtml->image('hoge', array('width'=>'80px')) ?>
    <?php endif?>
    <p><?= $user['User']['username'] ?></p>
</div>

<div class="action-content col-3">
<a href="/posts/add"><i class="fas fa-pen-fancy fa-5x"></i>
<p>記事を書く</p></a>
</div>

<div class="action-content col-3">
<a href="/posts/user/<?= $user['User']['id'] ?>"><i class="far fa-file-alt fa-5x"></i>
<p>記事一覧</p></a>
</div>

<div class="action-content col-3">
<a href="/profiles/edit"><i class="far fa-user fa-5x"></i>
<p>プロフィール編集</p></a>
</div>
</div>


<h2>プロフィール</h2>

<?php if (isset($user['Profile']['body'])):?>
<p><?= nl2br(h($user['Profile']['body'])) ?></p>
<?php else:?>
<p>XXXXXXXX</p>
<?php endif?>