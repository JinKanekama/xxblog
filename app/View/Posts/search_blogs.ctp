<!-- 検索画面 -->
<?= $this->assign('title', $keyword['word'].'の検索結果'); ?>

<?php foreach ($posts as $post): ?>
    <div class="blog-post">
        <a href="/posts/view/<?=$post['Post']['id']?>">
            <h2 class="text-dark post-title">
            <?= h($post['Post']['title']) ?>
            </h2>
        </a>
        <p class="created">
        <?php echo h($post['Post']['created'])." by ".h($post['User']['username']); ?>
        </p>
        <p>
        <?php echo nl2br(h($post['Post']['body']));?>
        </p>
    </div>
<?php endforeach; ?>


<?php echo $this->element('pager')?> 