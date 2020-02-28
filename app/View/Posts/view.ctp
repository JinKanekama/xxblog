<!-- File: /app/View/Posts/view.ctp -->
<?PHP echo $this->Html->css('view.css'); ?>

<h1><?php echo h($post['Post']['title']); ?></h1>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>

<!--　画像表示  -->
<div class="images">
 <?php  
    $base = "/files/image/name/" ;
    $num = 0;
    //初期表示画像
    foreach ($post['Image'] as $i) {
      $num3 = $num+1;
      if ($num3 % 2 !== 0) {
        echo '<div class="containers row">';
      }
      echo '<div class="display-wrapper col-md-6">';
      echo $this->Html->image( $base . $i['image_dir'] . "/" .$i['name'] , array('width'=> '100%', 'class' => "display", 'id' => "${num}"));
      echo '</div>';
      if ($num3 % 2 == 0  || $i == end($post['Image'])) {
        echo '</div>';
      }
      $num += 1;
    }
  ?>
</div>
  <?php
    $num2 = 0;
    //modal contents
    foreach ($post['Image'] as $i) {
      echo '<div class="popup '.$num2.'">';
      echo '<div class="container">';
      echo '<div class="under-container row">';
      echo '<div class="col-10">';
      echo '</div>';
      echo '<div class="col-2">';
      echo '<div class="close"><i class="far fa-window-close fa-2x" style="color:white";></i></div>';
      echo '</div>';
      echo '</div>';
      echo '<div class="popup-container row">';
      echo '<div class="col-2 left-content">';
      echo '<div class="rev"><i class="far fa-caret-square-left fa-5x" style="color:white";></i></div>';
      echo '</div>';
      echo '<div class="content-wrapper col-8">';
      echo $this->Html->image( $base . $i['image_dir'] . "/" . $i['name'] , array('class' => "modalImage"));
      echo '</div>';
      echo '<div class="col-2 right-content">';
      echo '<div class="next"><i class="far fa-caret-square-right fa-5x" style="color:white";></i></div>';
      echo '</div>';
      echo '</div>';

      echo '</div>';
      echo '</div>';
      $num2 += 1;

   
    }
 ?>


<?php
  
?>
<section class="post row" data-flag="<?php echo $goodFlag?>" data-postid="<?php echo $post['Post']['id'];?> "  data-recieveduserid="<?php echo $post['Post']['user_id'];?> ">
<?php 
if ($session = $this->Session->read('Auth.User.id')){
  echo '<div class="post-actions col-6">';
  echo $this->Html->link('編集', array('controller' => 'posts', 'action' => 'edit',$post['Post']['id'] ));
  echo $this->Form->postLink(
    '削除',
    array('controller' => 'posts','action' => 'delete', $post['Post']['id']),
    array('confirm' => '本当に削除しますか?')
  );
  echo  '</div>';
  if($goodFlag == 0){
    echo'<div class="good-items col-6">';
    echo '<div class="btn-good"><i class="far fa-heart"></i></div>';

  } else {
    echo '<div class="good-items col-6">';
    echo '<div class="btn-good active"><i class="fas fa-heart active"></i></div>';

  }
} else {
  echo '<div class="col-6"></div>';
  echo '<div class="good-items col-6">';
  echo '<div class="btn-good-default"><i class="far fa-heart"></i></div>';
}
echo '<div class="goods">'.count($post['Good']).'</div></div> ';

?>



</section>
 <?PHP echo $this->Html->script('modal.js'); ?>

 <?PHP echo $this->Html->script('good.js'); ?>
 



