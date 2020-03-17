<?= $this->assign('title', '都道府県検索') ; ?>

<h1>都道府県検索画面</h1>
<div class="form-group　row">
<input class="col-xs-9 form-control" type="text" id="code" name="" value="">
<button class="col-xs-3" type="button" id="searchBtn">検索</button>
</div>

<table class="area">
<tr>
<th>都道府県</th>
<th>市区町村</th>
<th>町域</th>
</tr>
<tr>
<td id="prefecture"></td>
<td id="city"></td>
<td id="town"></td>
</tr>
</table>

<?PHP echo $this->Html->script('postSearch.js'); ?>