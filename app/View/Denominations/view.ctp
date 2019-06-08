<div class="denominations view">
<h2><?php echo __('Denomination');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $denomination['Denomination']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $denomination['Denomination']['value']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Denomination'), array('action' => 'edit', $denomination['Denomination']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Denomination'), array('action' => 'delete', $denomination['Denomination']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $denomination['Denomination']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Denominations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Denomination'), array('action' => 'add')); ?> </li>
	</ul>
</div>
