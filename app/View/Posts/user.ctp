<?= $this->assign('title', $posts[0]['User']['username']."さんのページ"); ?>
<?PHP echo $this->Html->css('user.css'); ?>

<div class="row">
  <div class="col-3 user-profile">
    <?php 
      if($user['Icon'][0]){
        echo $this->CustomHtml->image('/files/icon/name/'.$user['Icon'][0]['icon_dir'].'/'. $user['Icon'][0]['name'], array('class'=>'w-100 rounded'));
      }else {
        echo $this->CustomHtml->image('hoge');
      }
    ?>
    <p><?=$user['User']['username']?></p>
  </div>
  <div class="col-md-9">
    <?php foreach ($posts as $post): ?>
      <article class="post-item border-top border-bottom row">
        <div class="col-1">
        <?php 
          if($user['Icon'][0]){
            echo $this->CustomHtml->image('/files/icon/name/'.$user['Icon'][0]['icon_dir'].'/thumb_'. $user['Icon'][0]['name'], array('class' => 'w-100 rounded'));
          }else {
            echo $this->CustomHtml->image('hoge', array('class' => 'rounded'));
          }
        ?>
        </div>
        <div class="post_body col-11">
          <a class="item_title" href="/posts/view/<?=$post['Post']['id']?>" >
            <?= h($post['Post']['title']) ?>
          </a>
          <?php  $day = new DateTime($post['Post']['created']);?>
          <p class="item_info"><?php echo 'by'.h($post['User']['username'])." ".$day->format('m/d H時'); ?></p>
          </div>
      </article>
      <?php endforeach; ?>
    <?php echo $this->element('pager')?> 
  </div>
</div>