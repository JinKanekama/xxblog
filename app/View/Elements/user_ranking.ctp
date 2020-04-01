<h3 class="border-bottom">ユーザーランキング</h3>

<?php $i = 1; //順位を格納 ?>
<?php foreach($user_ranking as $user):?>
<div class="row  border-bottom">
    <div class="col-2">
        <p><?=$i?>位</p>
    </div>
    <div class="col-2">
        <a href="/posts/user/<?= $user['User']['id'] ?>/new">
        <?php
            if(isset($user['Icon'][0])){
                echo $this->CustomHtml->image('/files/icon/name/'.$user['Icon'][0]['icon_dir'].'/thumb_'. $user['Icon'][0]['name'], array('class' => 'w-100 rounded'));
            }else {
                echo $this->CustomHtml->image('hoge', array('class' => 'w-100 rounded'));
            }
        ?>
        </a>
    </div>
    <div class="col-5">
        <a href="/posts/user/<?= $user['User']['id'] ?>"><p><?= $user['User']['username'] ?></p></a>
    </div>
    <div class="col-3">
        <p><?=  $user['Good']['Total']?><i class="fas fa-heart"></i></p>
    </div>
</div>
<?php $i++ ?>
<?php endforeach?>