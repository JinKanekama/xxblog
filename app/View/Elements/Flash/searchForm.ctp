<?php echo $this->Form->create('Post', array('url' => '/posts/index'));?>  
  
<fieldset>  
  <legend>Search!</legend>  
  <dl>  
    <dt><label>タイトル</label></dt>  
    <dd><?php echo $this->Form->input('title', array(  
      'type' => 'text', 'div' => false, 'label' => false));?></dd>  
    <dt><label>カテゴリー</label></dt>  
    <dd><?php echo $this->Form->input('category', array(  
      'type' => 'text', 'div' => false, 'label' => false ));?></dd>  
    <dt><label>タグ</label></dt>  
    <dd><?php echo $this->Form->input('tag', array(  
      'type' => 'text', 'div' => false, 'label' => false ));?></dd>  
  </dl>  
  
  <?php echo $this->Form->submit('検索', array('div' => false, 'escape' => false));?>  
  
</fieldset>  
  
<?php echo $this->Form->end();?> 