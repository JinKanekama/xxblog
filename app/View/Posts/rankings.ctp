<?= $this->assign('title', "ランキング"); ?>
<?PHP echo $this->Html->css('articles.css'); ?>
<?= Debugger::dump($rankings); ?>
<?= Debugger::dump($hoge); ?>


<h1>記事ランキング</h1>
<div class="row">
    <div class="col-md-2">
    <ul class="list-group">
        <li><a href="/posts/rankings/total">総合</a></li>
        <?php
            foreach($category_list as $item){
                echo '<li><a href="/posts/rankings/'.$item['Category']['id'].'">'.$item['Category']['name'].'</a></li>';
            }
        ?>
    </ul>
    </div>
    <div class="rankings-contents col-md-7">
        <h2 class="border-bottom"><?php echo $category_name ?></h2>
        <?php foreach($rankings as $item):?>
            <article class="post-item border-bottom row">
                <div class="col-1">
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
                <div class="post_body col-11">
                    <a class="item_title" href="/posts/view/<?=$item['Post']['id']?>" >
                        <?= h($item['Post']['title']) ?>
                    </a>
                    <?php  $day = new DateTime($item['Post']['created']);?>
                    <p class="item_info"><?php echo 'by<a href="/posts/user/'.$item['User']['id'].'/new">'.h($item['User']['username'])." </a>".'<span class="text-black-50">'.$day->format('m/d H時').'</span>'; ?> <?= $item['Good']['Total']?><i class="fas fa-heart"></i></p> 
                </div>
            </article>
        <?php endforeach?>
        <?php echo $this->element('pager')?> 
    </div>
    <div class="others-contents col-md-3">
        <?php echo $this->element('user_ranking')?> 
    </div>
</div>
