<!-- File: /app/View/Posts/index.ctp -->
<?PHP echo $this->Html->css('index.css'); ?>
<?= $this->assign('title', 'XXブログ'); ?>

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
            <?php if($blog['Image'][0]){
              echo $this->CustomHtml->image('/files/image/name/'. $blog['Image'][0]['image_dir'] .'/'.$blog['Image'][0]['name'], array('class'=>'d-block w-100 img-responsive rounded-lg', 'height'=>'300px', 'alt'=>'スライド'));
            } else {
              echo $this->CustomHtml->image('hoge', array('class'=>'d-block w-100 img-responsive rounded-lg', 'height'=>'300px', 'alt'=>'スライド'));
            }
            ?>
              <div class="carousel-caption d-none d-md-block w-100">
              　 <div class="slide-title">
                <?php 
                  $text = $blog['Post']['title']; 
                  $limit = 32;
                  if(mb_strlen($text) > $limit) {
                    $title = mb_substr($text,0,$limit);
                    echo h($title).'･･･' ;
                  } else {
                    echo h($text);
                  }
                ?>
                </div>
              </div><!-- /.carousel-caption -->
              </a>
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
<!-- 速報 -->
<div class="news-contents">
<h2 class="border-bottom">ブログ速報</h2>
  <div class="row">
  <div class="col-md-6 news-left-contents">
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
      <?php foreach($news as $item):?>
        <a class="border-bottom" href="/posts/view/<?=$item['Post']['id']?>">
            <div class="row">
              <?php  $day = new DateTime($item['Post']['created']);?>
              <div class="col-3 time-box"><span class="time"><?=$day->format('m/d H時');?></span></div>
              <div class="col-7 title-box"><span class="title">
                <?php 
                  $text = $item['Post']['title']; 
                  $limit = 26;
                  if(mb_strlen($text) > $limit) {
                    $title = mb_substr($text,0,$limit);
                    echo h($title).'･･･' ;
                  } else {
                    echo h($text);
                  }
                ?>
              </span></div>
            </div>
            <div class="row">
              <div class="col-10"></div>
              <div class="col-2 author-box"><span class="author text-black-50">by<?=h($item['User']['username']);?></span></div>
            </div>
        </a>  
      <?php endforeach?>
      <a class="more" href="/posts/news/total">>>もっと見る</a>
    </div>
    <div class="tab-pane fade" id="item2" role="tabpanel" aria-labelledby="item2-tab">
      <?php foreach($animals_news as $item):?>
        <a href="/posts/view/<?=$item['Post']['id']?>">
           <div class="row">
            <?php  $day = new DateTime($item['Post']['created']);?>
            <div class="col-3 time-box"><span class="time"><?=$day->format('m/d H時');?></span></div>
            <div class="col-7 title-box"><span class="title">
              <?php 
                  $text = $item['Post']['title']; 
                  $limit = 26;
                  if(mb_strlen($text) > $limit) {
                    $title = mb_substr($text,0,$limit);
                    echo h($title).'･･･' ;
                  } else {
                    echo h($text);
                  }
              ?>
            </span></div>
            <div class="col-2 author-box"><span class="author text-black-50">by<?=h($item['User']['username']);?></span></div>
            </div>
        </a>
      <?php endforeach?>
      <a class="more" href="/posts/news/1">>>もっと見る</a>
    </div>
  </div>
  </div>
    <div class="col-md-6 news-right-contents">
      <div class="row h-50">
        <div class="col-6  left">
          <div class="news-right-wrapper h-100"> 
             <a href="/posts/news/total">
              <div class="news-img">
                <?php if (isset($news[0]['Image'][0]))  {
                  echo $this->CustomHtml->image('/files/image/name/'. $news[0]['Image'][0]['image_dir'] .'/'.$news[0]['Image'][0]['name'], array('width'=>'100%', 'height'=>'120px'));
                } else {
                  echo $this->CustomHtml->image('hoge',array('width'=>'100%', 'height'=>'120px') );
                }

                ?>
              
              </div> 
              <p class="news-category">総合速報</p>
              <p class="title">
                <?php 
                  $text = $news[0]['Post']['title']; 
                  $limit = 20;
                  if(mb_strlen($text) > $limit) {
                    $title = mb_substr($text,0,$limit);
                    echo h($title).'･･･' ;
                  } else {
                    echo h($text);
                  }
                ?>
              </p>
            </a>
          </div>
        </div>
        <div class="col-6 right">
          <div class="news-right-wrapper h-100">
              <a href="/posts/news/1">  
              <div class="news-img">
              <?php if (isset($animals_news[0]['Image'][0])){
                echo $this->CustomHtml->image('/files/image/name/'. $animals_news[0]['Image'][0]['image_dir'] .'/'.$animals_news[0]['Image'][0]['name'], array('width'=>"100%", 'height'=>"120px"));
                } else {
                  echo $this->CustomHtml->image('hoge',array('width'=>"100%", 'height'=>"120px") );
                }
              ?>
              
              </div> 
              <p class="news-category">動物速報</p>
              <p class="title">
              <?php 
                $text = $animals_news[0]['Post']['title']; 
                $limit = 20;
                if(mb_strlen($text) > $limit) {
                  $title = mb_substr($text,0,$limit);
                  echo h($title).'･･･' ;
                } else {
                  echo h($text);
                }
                ?>  
              </p>
              </a>
          </div>
        </div>
      </div>
      <div class="row h-50">
        <div class="col-6  left">
          <div class="news-right-wrapper h-100"> 
            <a href="/posts/news/2">
              <div class="news-img">
              <?php if (isset($programmings_news[0]['Image'][0])){
                echo $this->CustomHtml->image('/files/image/name/'. $programmings_news[0]['Image'][0]['image_dir'] .'/'.$programmings_news[0]['Image'][0]['name'], array('width'=>"100%", 'height'=>"120px"));
                } else {
                  echo $this->CustomHtml->image('hoge',array('width'=>"100%", 'height'=>"120px") );
                }
              ?>
              
              </div> 
              <p class="news-category">プログラミング速報</p>
              <p class="title">
              <?php 
                $text = $programmings_news[0]['Post']['title']; 
                $limit = 20;
                if(mb_strlen($text) > $limit) {
                  $title = mb_substr($text,0,$limit);
                  echo h($title).'･･･' ;
                } else {
                  echo h($text);
                }
                ?>   
              </p>
            </a>
          </div>
        </div>
        <div class="col-6  right">
          <div class="news-right-wrapper h-100">
              <a href="/posts/news/3">  
              <div class="news-img">
              <?php if (isset($others_news[0]['Image'][0])){
                echo $this->CustomHtml->image('/files/image/name/'. $others_news[0]['Image'][0]['image_dir'] .'/'.$others_news[0]['Image'][0]['name'], array('width'=>"100%", 'height'=>"120px"));
              } else {
                echo $this->CustomHtml->image('hoge', array('width'=>"100%", 'height'=>"120px"));
              }
              ?>
              </div> 
              <p class="news-category">その他の速報</p>
              <p class="title">
              <?php 
                $text = $others_news[0]['Post']['title']; 
                $limit = 20;
                if(mb_strlen($text) > $limit) {
                  $title = mb_substr($text,0,$limit);
                  echo h($title).'･･･' ;
                } else {
                  echo h($text);
                }
                ?>  
              </p>
              </a>
          </div>
        </div>
      </div>
    </div><!-- end right contets -->
  </div><!-- endrow -->
</div><!-- end news-contets -->
<!-- ランキングメニュー -->
<div class="ranking-contents">
  <h2 class="border-bottom">ランキング</h2>
    <h3>記事</h3>
    <div class="row">
      <?php $i = 1; ?>
      <?php for($n=0;$n<4;$n++ ):?>
      <div class="col-md-3 ranking-wrapper">
        <a href="/posts/view/<?= $ranking[$n]['Post']['id'] ?>">
        <p class="rank"><?=$i?>位</p>
        <div class="img-wrapper">
        <?php
          if (isset($ranking[$n]['Image'][0])){
            echo $this->CustomHtml->image('/files/image/name/'.$ranking[$n]['Image'][0]['image_dir'].'/thumb_'.$ranking[$n]['Image'][0]['name'], array('class' => 'd-block mx-auto rounded', 'width'=>'50%'));
          } else {
            echo $this->CustomHtml->image('hoge', array('width'=>'50%', 'class' => 'd-block mx-auto'));
          }
        ?> 
        </div>
        <p class="ranking-title">
        <?php 
          $text = $ranking[$n]['Post']['title']; 
          $limit = 20;
          if(mb_strlen($text) > $limit) {
            $title = mb_substr($text,0,$limit);
            echo h($title).'･･･' ;
          } else {
            echo h($text);
          }
        ?>    
        </p>
        </a>
      </div>
      <?php $i++;?>
      <?php endfor; ?>
    </div>
    <div class="row border-bottom more-wrapper">
      <a class="col text-right ranking-more" href="posts/rankings/total">>>もっと見る</a>
    </div>
    
    <h3>ブロガー</h3>
    <div class="row">
      <?php $i = 1; ?>
      <?php for($n=0;$n<4;$n++ ):?>
      <div class="col-md-3 ranking-wrapper">
        <a href="/posts/user/<?= $ranking2[$n]['User']['id'] ?>/new">
        <p class="rank"><?=$i?>位</p>
        <div class="img-wrapper">
        <?php
          if (isset($ranking2[$n]['Icon'][0])){
            echo $this->CustomHtml->image('/files/icon/name/'.$ranking2[$n]['Icon'][0]['icon_dir'].'/thumb_'.$ranking2[$n]['Icon'][0]['name'], array('class' => 'd-block mx-auto rounded', 'width'=>'50%'));
          } else {
            echo $this->CustomHtml->image('hoge', array('width'=>'50%', 'class' => 'd-block mx-auto'));
          }
        ?> 
        </div>
        <p> <?= h($ranking2[$n]['User']['username']) ?></p>  
        </a>
      </div>
      <?php $i++;?>
      <?php endfor; ?>
    </div>
    <div class="row border-bottom more-wrapper">
      <a class="col text-right ranking-more">>>もっと見る</a>
    </div>
    
</div>
<!-- お知らせメニュー -->
<div class="notice-contents">
  <h2 class="border-bottom">お知らせ</h2>
    <div class="row border-bottom">
        <span class="day col-3">2/25</span>
        <span class="comment col-9">当ブログについてのXXなお知らせ</span>
    </div>
    <div class="row border-bottom">
        <span class="day col-3">2/24</span>
        <span class="comment col-9">20XX年に一般公開しました。</span>
    </div>
</div>

<?PHP echo $this->Html->script('index.js'); ?>
