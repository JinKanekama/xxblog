<?= $this->assign('title', $user['User']['username'].'さんのページ') ; ?>

<?php if (isset($user['Profile']['blog_title'])):?>
<h1><?= h($user['Profile']['blog_title']) ?></h1>
<?php else: ?>
<h1>XX</h1>
<?php endif?>

<?= $user['User']['username'].'さん' ?>

<?php if (isset($user['Icon'][0])):?>
<?php $icon_sorce = '/files/icon/name/'.$user['Icon'][0]['icon_dir'].'/thumb_'.$user['Icon'][0]['name'] ?>
<a href="/profiles/edit"><?=  $this->CustomHtml->image($icon_sorce) ?></a>
<?php else:?>
<a href="/profiles/edit"><?=  $this->CustomHtml->image('hoge', array('width'=>'80px')) ?></a>
<?php endif?>

<a href="/posts/add">記事を書く</a>
<a href="/posts/mypage">投稿一覧</a>
<a href="/profiles/edit">プロフィール編集</a>
<h2>プロフィール</h2>

<?php if (isset($user['Profile']['body'])):?>
<p><?= nl2br(h($user['Profile']['body'])) ?></p>
<?php else:?>
<p>XXXXXXXX</p>
<?php endif?>