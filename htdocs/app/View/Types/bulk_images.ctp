<div class="types form">
<?php echo $this->Form->create('Bulk', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php echo __('Bulk images update'); ?></legend>
 		<p><?php echo __('Upload a ZIP file with images named by coin ID or Label'); ?></p>
	<?php
		echo $this->Form->input('file', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
<?php
if (isset($result)) {
  echo $this->Html->tag('p', implode('<br />', $result));
}
?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
	</ul>
</div>
