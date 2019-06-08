<?php echo $this->Html->script('ckeditor/ckeditor', array('inline' => false)); ?>
<div class="coins form">
<?php echo $this->Form->create('Coin', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php echo __('Add Coin for type'); ?> <?=$type_name?></legend>
	<?php
		echo $this->Form->input('label');
		echo $this->Form->input('year');
		echo $this->Form->input('mint_mark');
		echo $this->Form->input('grade_id');
		echo $this->Fck->ckedit('Coin.comment', '', array('label' => __('Comment')));
		echo $this->Form->input('restored');
		echo $this->Form->input('cleaned');
		echo $this->Form->input('dirty');
		echo $this->Form->input('damaged');
		echo $this->Form->input('possible_error');
		echo $this->Form->input('for_sale');
		echo $this->Form->input('value', array('default'=>0.00));
		echo $this->Form->input('bought_for', array('default'=>0.00));
		echo $this->Form->input('image', array('type' => 'file'));
		// Oculto el ID de tipo
		echo $this->Form->input('type_id', array('type' => 'hidden', 'value' => $id));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Coins'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grades'), array('controller' => 'grades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grade'), array('controller' => 'grades', 'action' => 'add')); ?> </li>
	</ul>
</div>
