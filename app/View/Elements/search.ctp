<?php echo $this->Form->create('Post', array('url' => '/posts/index'));?>  
  

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
    echo $this->Form->input('Post.tag', array( 
    'type' => 'select', 
    'multiple'=> 'checkbox',
    'options' =>  $tagCheck,
    'label' => 'タグ' 
    ));  
    
    echo '<button type="submit" class="btn btn-primary">検索</button>';
   ?>  
  </div>

<?php echo $this->Form->end();?> 