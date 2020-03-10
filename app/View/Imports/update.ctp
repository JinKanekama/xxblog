<?= $this->assign('title', 'CSV更新') ; ?>

<h1>CSV更新画面</h1>
<?= $this->Form->create('Import', array('type' => 'file')) ?>
<?= $this->Form->file('Import.submittedfile',[ 'accept'=>'.csv']); ?>
<?= $this->Form->button('Submit'); ?>
<?= $this->Form->end() ?>