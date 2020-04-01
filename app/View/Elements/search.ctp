<?php echo $this->Form->create('Post', array('url' => '/posts/searchBlogs'));?>  
  <div class="search"> 
  <?php
    echo '<div class="form-group">';
    echo '<label for="FormControlTile">タイトル</label>';
    echo $this->Form->input('Post.title', array(  
      'label' => false, 'class'=>'form-control', 'rows' => '1'));
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="FormControlCategory">カテゴリー</label>';
    echo $this->Form->input('Post.category', array(  
      'label' => false, 'class'=>'form-control', 'rows' => '1'));
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="FormControlTag">タグ</label>';
    echo $this->Form->input('Post.tag', array( 
    'type' => 'select', 
    'multiple'=> 'checkbox',
    'options' =>  $tagCheck,
    'label' => false 
    ));  
    echo '</div>';
    echo '<div class="button_wrapper">';
    echo '<button type="submit" class="btn btn-primary">検索</button>';
    echo '</div>' ;
   ?>  
  </div>
<?php echo $this->Form->end();?> 

