<h2 class="text-dark">お問い合わせ</h2>
<?php echo $this->Form->create('Contact', array('type' => 'file')); 
echo '<div class="form-group">';
echo '<label for="FormControlTextarea1">お名前</label>';
echo $this->Form->input('Contact.name', array('div'=>false, 'label' => false,"class"=>"form-control", 'rows' => '1'));
echo '</div>';
echo '<div class="form-group">';
echo '<label for="InputEmail">メールアドレス</label>';
echo $this->Form->input('Contact.email', array('div'=>false, 'type' => 'email','label' => false,"class"=>"form-control", "placeholder" => "Enter email"));
echo '</div>';
echo '<div class="form-group">';
echo '<label for="FormControlTextarea2">お問い合わせ内容</label>';
echo $this->Form->input('Contact.content', array('div'=>false, 'label' => false,"class"=>"form-control", 'rows' => '5'));
echo '</div>';
echo '<button type="submit" class="btn btn-primary">送信</button>';
echo $this->Form->end();
?>

<?php debug($massage) ?>


