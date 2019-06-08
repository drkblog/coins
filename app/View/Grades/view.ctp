<div class="grades view">
<h2><?php echo __('Grade');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grade['Grade']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Acronym'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grade['Grade']['acronym']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grade['Grade']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Grade'), array('action' => 'edit', $grade['Grade']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Grade'), array('action' => 'delete', $grade['Grade']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $grade['Grade']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Grades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grade'), array('action' => 'add')); ?> </li>
	</ul>
</div>
