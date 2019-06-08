<div class="grades form">
<?php echo $this->Form->create('Grade');?>
	<fieldset>
 		<legend><?php echo __('Add Grade'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('acronym');
		echo $this->Form->input('position');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Grades'), array('action' => 'index'));?></li>
	</ul>
</div>