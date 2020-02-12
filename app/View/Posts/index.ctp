<!-- File: /app/View/Posts/index.ctp -->
<?PHP echo $this->Html->css('index.css'); ?>

<h1><?php echo $this->Html->link('Blog posts', array('action' => 'index'), array('class' => 'text-dark blog-title')); ?></h1>

<div class="row">
<div class="col-md-8">
<?php foreach ($posts as $post): ?>
    <?php //Debugger::dump($post) ;?>
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
</div>
<div class="col-md-4">
<?php echo $this->element('search')?> 
</div>
</div>

<!-- index.jsファイル読み込み -->
<?php echo $this->Html->script('index.js'); ?>

