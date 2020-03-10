<?= $this->assign('title', '都道府県選択') ; ?>

<h1>都道府県選択画面</h1>

<span>都道府県：</span>
<select id="prefecture">
<option>選択してください</option>
<?php
foreach($data as $part) {
    echo '<option value="'.$part.'">'.$part.'</option>';
}
?>
</select>
<span>市区町村：</span>
<select id="city">
<option>選択してください</option>
</select>

<span>町域：</span>
<select id="town">
<option>選択してください</option>
</select>

<?PHP echo $this->Html->script('selectAjax.js'); ?>