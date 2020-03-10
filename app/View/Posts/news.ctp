<?= $this->assign('title', "速報"); ?>
<?PHP echo $this->Html->css('articles.css'); ?>

<h1>ブログ速報</h1>
<div class="row">
    <div class="col-md-2">
    <ul>
        <li><a href="/posts/news/total">総合</a></li>
        <?php
            foreach($category_list as $item){
                echo '<li><a href="/posts/news/'.$item['Category']['id'].'">'.$item['Category']['name'].'</a></li>';
            }
        ?>

    </ul>
    </div>
    <div class="news-contents col-md-7">
        <h2><?php echo $category_name ?></h2>
        <?php foreach($news as $item):?>
            <article class="post-item border-top border-bottom row">
                <div class="col-1">
                    <a href="/posts/user/<?=$item['User']['id']?>">
                    <?php 
                        if($item['User']['Icon'][0]){
                            echo $this->CustomHtml->image('/files/icon/name/'.$item['User']['Icon'][0]['icon_dir'].'/thumb_'. $item['User']['Icon'][0]['name'], array('class' => 'w-100 rounded'));
                        }else {
                            echo $this->CustomHtml->image('hoge', array('class' => 'rounded'));
                        }
                    ?>
                    </a>
                </div>
                <div class="post_body col-11">
                    <a class="item_title" href="/posts/view/<?=$item['Post']['id']?>" >
                        <?= h($item['Post']['title']) ?>
                    </a>
                    <?php  $day = new DateTime($item['Post']['created']);?>
                    <p class="item_info"><?php echo 'by<a href="/posts/user/'.$item['User']['id'].'">'.h($item['User']['username'])."</a> ".$day->format('m/d H時'); ?></p>
                </div>
            </article>
        <?php endforeach?>
        <?php echo $this->element('pager')?> 
    </div>
    <div class="others-contents col-md-3">
        <h3>ユーザーランキング</h3>
    </div>
</div>
