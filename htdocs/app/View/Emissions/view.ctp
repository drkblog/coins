<div class="emissions view">
<h2><?php echo __('Emission');?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo $emission['Emission']['name']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo $emission['Emission']['description']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($emission['Country']['name'], array('controller' => 'countries', 'action' => 'view', $emission['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Territory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($emission['Territory']['name'], array('controller' => 'territories', 'action' => 'view', $emission['Territory']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Emission'), array('action' => 'edit', $emission['Emission']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Emission'), array('action' => 'delete', $emission['Emission']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $emission['Emission']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Emissions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emission'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
	</ul>
</div>
