<?= $this->assign('title', '都道府県検索') ; ?>

<h1>都道府県検索画面</h1>

<input type="text" id="code" name="" value="">
<button type="button" id="searchBtn">検索</button>

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