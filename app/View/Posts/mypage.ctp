
<?php foreach ($posts as $post): ?>

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