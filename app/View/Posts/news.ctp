<?= $this->assign('title', "速報"); ?>
<?PHP echo $this->Html->css('articles.css'); ?>
<h1>ブログ速報</h1>
<div class="row">
    <div class="col-md-2">
    <ul>
        <?php 
          if ($category_name == "総合") {
            echo '<li><a class="c-active" href="/posts/news/total">総合</a></li>';
          } else {
            echo '<li><a href="/posts/news/total">総合</a></li>';
          }
        ?>
        <?php
            foreach($category_list as $item){
                if ($item['Category']['name'] == $category_name){
                    echo '<li><a class="c-active" href="/posts/news/'.$item['Category']['id'].'">'.$item['Category']['name'].'</a></li>';
                } else {
                    echo '<li><a href="/posts/news/'.$item['Category']['id'].'">'.$item['Category']['name'].'</a></li>';
                }
            }
        ?>
    </ul>
    </div>
    <div class="news-contents col-md-7">
        <h2 class="border-bottom"><?php echo $category_name ?></h2>
        <?php foreach($news as $item):?>
            <article class="post-item border-bottom row">
                <div class="col-2">
                    <a href="/posts/view/<?=$item['Post']['id']?>" >
                    <?php 
                        if(isset($item['Image'][0])){
                            echo $this->CustomHtml->image('/files/image/name/'.$item['Image'][0]['image_dir'].'/thumb_'. $item['Image'][0]['name'], array('class' => 'w-100 rounded'));
                        }else {
                            echo $this->CustomHtml->image('hoge', array('class' => 'w-100 rounded'));
                        }
                    ?>
                    </a>
                </div>
                <div class="post_body col-10">
                    <a class="item_title" href="/posts/view/<?=$item['Post']['id']?>" >
                        <?= h($item['Post']['title']) ?>
                    </a>
                    <?php  $day = new DateTime($item['Post']['created']);?>
                    <p class="item_info"><?php echo 'by<a href="/posts/user/'.$item['User']['id'].'/new">'.h($item['User']['username']).'</a> '.'<span class="text-black-50">'.$day->format('m/d H時').'</span>'; ?></p>
                </div>
            </article>
        <?php endforeach?>
        <?php echo $this->element('pager')?> 
    </div>
    <div class="others-contents col-md-3">
        <?php echo $this->element('user_ranking')?> 
    </div>
</div>

