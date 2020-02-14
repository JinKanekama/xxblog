<!-- File: /app/View/Posts/index.ctp -->
<?PHP echo $this->Html->css('index.css'); ?>

<!--スライドショー  -->
<div id="carouselOption1" class="carousel slide" data-ride="carousel">
  <!-- インジケータの設定 -->
  <ol class="carousel-indicators">
    <li data-target="#carouselOption1" data-slide-to="0" class="active"></li>
    <li data-target="#carouselOption1" data-slide-to="1"></li>
    <li data-target="#carouselOption1" data-slide-to="2"></li>
  </ol>
  <!-- スライドさせる画像の設定 -->
  <div class="carousel-inner">
  <?php $num = 0;?>
    <?php for($i=0; $num < 3 ; $i++): ?>
        <?php $blog = $blogs[$i] ;?>
        <?php if ($blog['Image']) :?>
            <?php if ($num==0){
                echo '<div class="carousel-item active">';
            } else {
                echo '<div class="carousel-item">';
            } ?>
                <?=  '<img class="d-block w-100 img-responsive" width="100%" height="300px" src="/files/image/name/'. $blog['Image'][0]['image_dir'] .'/'.$blog['Image'][0]['name'].'" alt="第1スライド">';?>
                <div class="carousel-caption d-none d-md-block">
                　<?= '<h5>'.$blog['Post']['title'].'</h5>'; ?>
                　<?= '<p>by '.$blog['User']['username'].'</p>'; ?>
                </div><!-- /.carousel-caption -->
            </div><!-- /.carousel-item -->
            <?php $num++; ?>
        <?php endif; ?>
    <?php endfor; ?>
  </div>
  <!-- スライドコントロールの設定 -->
  <a class="carousel-control-prev" href="#carouselOption1" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">前へ</span>
  </a>
  <a class="carousel-control-next" href="#carouselOption1" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">次へ</span>
  </a>
</div>

<h1><?php echo $this->Html->link('Blog posts', array('action' => 'index'), array('class' => 'text-dark blog-title')); ?></h1>

<div class="row">
<div class="col-md-8">
<?php foreach ($posts as $post): ?>
    <?php //Debugger::dump($post) ;?>
    <div class="blog-post">
    <h2>
    <?php
        echo $this->Html->link(
            $post['Post']['title'],
            array('action' => 'view', $post['Post']['id']),
            array('class' => 'text-dark post-title')
        );
    ?>
    </h2>
    <p class="created">
    <?php echo $post['Post']['created']." by ".$post['User']['username']; ?>
    </p>
    <p>
    <?php echo $post['Post']['body'];?>
    </p>
    </div>
<?php endforeach; ?>


<?php echo $this->element('pager')?> 
</div>
<div class="col-md-4">
<?php echo $this->element('search')?> 
</div>
</div>

<!-- index.jsファイル読み込み -->
<?php echo $this->Html->script('index.js'); ?>

