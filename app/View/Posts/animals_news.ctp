<?= $this->assign('title', "速報"); ?>
<div class="row">
    <div class="news-contents col-md-8">
        <h1>ブログ速報</h1>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item1" aria-selected="true">総合</a>
            </li>
            <li class="nav-item active show">
            <a class="nav-link" id="item2-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item2" aria-selected="false">動物</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="item3-tab" data-toggle="tab" href="#item3" role="tab" aria-controls="item3" aria-selected="false">プログラミング</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="item4-tab" data-toggle="tab" href="#item4" role="tab" aria-controls="item4" aria-selected="false">その他</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade" id="item1" role="tabpanel" aria-labelledby="item1-tab">
            </div>
            <div class="tab-pane fade  active show " id="item2" role="tabpanel" aria-labelledby="item2-tab">
            <?php foreach($animals_news as $item):?>
                <a href="/posts/view/<?=$item['Post']['id']?>">
                    <div class="row">
                        <?php  $day = new DateTime($item['Post']['created']);?>
                        <div class="col-3 time-box"><span class="time"><?=$day->format('m/d H時');?></span></div>
                        <div class="col-7 title-box"><span class="title"><?=h($item['Post']['title']);?></span></div>
                        <div class="col-2 author-box"><span class="author">by<?=h($item['User']['username']);?></span></div>
                    </div>
                </a>
            <?php endforeach?>
            </div>
        </div>
    </div>
    <div class="others-contents col-md-4">
    </div>
</div>