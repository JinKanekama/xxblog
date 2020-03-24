<?= $this->assign('title', $posts[0]['User']['username']."さんのページ"); ?>
<?PHP echo $this->Html->css('user.css'); ?>

<div class="row">
  <div class="col-md-3 user-profile">
    <?php 
      if(isset($user['Icon'][0])){
        echo $this->CustomHtml->image('/files/icon/name/'.$user['Icon'][0]['icon_dir'].'/'. $user['Icon'][0]['name'], array('class'=>'w-100 rounded'));
      }else {
        echo $this->CustomHtml->image('hoge', array('class' => 'w-100 rounded'));
      }
    ?>
    <p><?= h($user['User']['username'])?></p>
    <p><?= nl2br(h($user['Profile']['body'])); ?></p>
  </div>
  <div class="col-md-9">
    <ul class="nav nav-tabs" role="tablist">
      <?php if($arg == "new"):?>
        <li class="nav-item">
          <a class="nav-link  active" id="item1-tab" href="/posts/user/<?= $user['User']['id'] ?>/new" role="tab" aria-controls="item1" >新着順</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="item2-tab" href="/posts/user/<?= $user['User']['id'] ?>/good" role="tab" aria-controls="item2" >いいね順</a>
        </li>
      <?php elseif($arg == "good"):?>
        <li class="nav-item">
          <a class="nav-link" id="item1-tab" href="/posts/user/<?= $user['User']['id'] ?>/new" role="tab" aria-controls="item1" >新着順</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  active" id="item2-tab" href="/posts/user/<?= $user['User']['id'] ?>/good" role="tab" aria-controls="item2" >いいね順</a>
        </li>
      <?php endif?>
    </ul>
    <div class="tab-content">
        <?php foreach ($posts as $post): ?>
          <article class="post-item border-bottom row">
            <div class="col-1">
            <?php 
              if(isset($post['Image'][0])){
                echo $this->CustomHtml->image('/files/image/name/'.$post['Image'][0]['image_dir'].'/thumb_'. $post['Image'][0]['name'], array('class' => 'w-100 rounded'));
              }else {
                echo $this->CustomHtml->image('hoge', array('class' => 'w-100 rounded'));
              }
            ?>
            </div>
            <div class="post_body col-11">
              <a class="item_title" href="/posts/view/<?=$post['Post']['id']?>" >
                <?= h($post['Post']['title']) ?>
              </a>
              <?php  $day = new DateTime($post['Post']['created']);?>
              <p class="item_info"><?php echo 'by'.h($post['User']['username'])." ".'<span class="text-black-50">'.$day->format('m/d H時').'</span>'; ?></p>
              </div>
          </article>
        <?php endforeach; ?>
      <?php echo $this->element('pager')?> 
    </div>
  </div>
</div>

<?PHP echo $this->Html->script('nav.js'); ?>