<!-- 検索画面 -->
<?= $this->assign('title', '検索結果'); ?>
<?PHP echo $this->Html->css('searchBlogs.css'); ?>

<div class="row">
    <div class="col-md-8 result-contents">
    <h1>検索結果</h1>
        <?php foreach ($posts as $post): ?>
            <article class="post-item border-top border-bottom row">
                <div class="col-2">
                    <a href="/posts/user/<?=$post['User']['id']?>">
                    <?php 
                        if(isset($post['User']['Icon'][0])){
                            echo $this->CustomHtml->image('/files/icon/name/'.$post['User']['Icon'][0]['icon_dir'].'/thumb_'. $post['User']['Icon'][0]['name'], array('class' => 'w-100 rounded'));
                        }else {
                            echo $this->CustomHtml->image('hoge', array('class' => 'w-100 rounded'));
                        }
                    ?>
                    </a>
                </div>
                <div class="post_body col-10">
                    <a class="item_title" href="/posts/view/<?=$post['Post']['id']?>" >
                        <?= h($post['Post']['title']) ?>
                    </a>
                    <?php  $day = new DateTime($post['Post']['created']);?>
                    <p class="item_info"><?php echo 'by<a href="/posts/user/'.$post['User']['id'].'">'.h($post['User']['username'])."</a> ".$day->format('m/d H時'); ?></p>
                </div>
            </article>
        <?php endforeach; ?>
        <?php echo $this->element('pager')?> 
    </div>
    <div class="col-md-4">
        <?php echo $this->element('search')?> 
    </div>
</div>


