<?php echo $this->Form->create('Post', array('url' => '/posts/index'));?>  
  
<fieldset>  
  <div class="search"> 
    <?php echo $this->Form->input('Post.title', array(  
      'type' => 'text', 'div' => false, 'label' => 'タイトル'));?>
    <?php echo $this->Form->input('Post.category', array(  
      'type' => 'text', 'div' => false, 'label' => 'カテゴリー' ));?>
    
    <?php echo $this->Form->input('Post.tag', array( 
      'type' => 'select', 
      'multiple'=> 'checkbox',
      'options' =>  $tagCheck,
      'label' => 'タグ' 
    ));?>  
 
  <?php echo $this->Form->submit('検索', array('div' => false, 'escape' => false));?>  
  </div>
</fieldset>  
  
<?php echo $this->Form->end();?> 