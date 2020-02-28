<!-- File: /app/View/Posts/index.ctp -->
<?PHP echo $this->Html->css('index.css'); ?>

<!--スライドショー  -->
<div id="carouselOption1" class="carousel slide" data-ride="carousel">
  <!-- インジケータの設定 -->
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
            } 
            ?>  
              <?= '<a href="/posts/view/'. $blog['Post']['id'] .'">' ?>
              <?=  '<img class="d-block w-100 img-responsive" width="100%" height="300px" src="/files/image/name/'. $blog['Image'][0]['image_dir'] .'/'.$blog['Image'][0]['name'].'" alt="スライド">';?>
              </a>
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
<!-- ニュースメニュー -->
<div class="news-contents">
<h2>ブログ速報</h2>
  <div class="row">
  <div class="col-8">
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item1" aria-selected="true">総合</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="item2-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item2" aria-selected="false">動物</a>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade show active" id="item1" role="tabpanel" aria-labelledby="item1-tab">
      <h3>総合</h3>
      <?php foreach($news as $item):?>
        <a href="/posts/view/<?=$item['Post']['id']?>">
            <?php  $day = new DateTime($item['Post']['created']);?>
            <span class="time"><?=$day->format('m月d日 H時');?></span>
            <span class="title"><?=$item['Post']['title']?></span>
            <span class="author">by<?=$item['User']['username']?></span>
        </a>
      <?php endforeach?>
    </div>
    <div class="tab-pane fade" id="item2" role="tabpanel" aria-labelledby="item2-tab">
      <h3>動物</h3>
      <?php foreach($animals_news as $item):?>
        <a href="/posts/view/<?=$item['Post']['id']?>">
            <?php  $day = new DateTime($item['Post']['created']);?>
            <span class="time"><?=$day->format('m月d日 H時');?>　</span>
            <span class="title"><?=$item['Post']['title']?></span>
            <span class="author">by<?=$item['User']['username']?></span>
        </a>
      <?php endforeach?>
    </div>
  </div>
  </div>
    <div class="col-4 news-right-contents">
        <a href="/posts/view/<?=$news[1]['Post']['id']?>">  
        <div class="news-right-wrapper">
        <div class="news-img">
        <?=  '<img  width="100%" height="120px" src="/files/image/name/'. $news[1]['Image'][0]['image_dir'] .'/'.$news[1]['Image'][0]['name'].'" >';?>
        </div> 
        <p>総合速報</p>
        <span><?= $news[0]['Post']['title'] ?></span>
        </div>
        </a>
        <a href="/posts/view/<?=$animals_news[0]['Post']['id']?>">  
        <div class="news-right-wrapper">
        <div class="news-img">
        <?=  '<img width="100%" height="120px" src="/files/image/name/'. $animals_news[0]['Image'][0]['image_dir'] .'/'.$animals_news[0]['Image'][0]['name'].'" >';?>
        </div> 
        <p>動物速報</p>
        <span><?= $animals_news[0]['Post']['title'] ?></span>
        </div>
        </a>
    </div>
</div>
<!-- ランキングメニュー -->
<div class="ranking-contents">
  <h2>ランキング</h2>
    <h3>記事ランキング</h3>
    <div class="row">
      <?php $i = 1; ?>
      <?php for($n=0;$n<3;$n++ ):?>
      <div class="col-md-4 ranking-wrapper">
        <p><?=$i?>位</p>
        <a href="posts/view/<?= $ranking[$n]['Post']['id'] ?>">
        <div class="ranking-img"> <?= '<img height="203px" width="100%" src="/files/image/name/'.$ranking[$n]['Image'][0]['image_dir'] .'/'.$ranking[$n]['Image'][0]['name'].'">' ?></div>
        <p><?= $ranking[$n]['Post']['title'] ?></p>
        </a>
      </div>
      <?php $i++;?>
      <?php endfor; ?>
    </div>
    <h3>ブロガーランキング</h3>
    <div class="row">
      <?php $i = 1; ?>
      <?php for($n=0;$n<3;$n++ ):?>
      <div class="col-md-4 ranking-wrapper">
        <p><?=$i?>位</p>
        <p> <?= $ranking2[$n]['User']['username'] ?></p>  
      </div>
      <?php $i++;?>
      <?php endfor; ?>
    </div>
</div>
<!-- お知らせメニュー -->
<div class="notice-contents">
  <h2>お知らせ</h2>
    <div class="row">
        
    </div>
</div>



