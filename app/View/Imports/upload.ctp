<?= $this->assign('title', 'CSVインポート画面') ; ?>

<h1>CSVインポート画面</h1>

<div class="form-group">
<?= $this->Form->create('Import', array('type' => 'file')) ?>
<?= $this->Form->file('Import.submittedfile',[ 'accept'=>'.csv']); ?>
<?= $this->Form->button('確定'); ?>
<?= $this->Form->end() ?>
</div>