<div class="territories index">
	<h2><?php echo __('Territories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
  	<? if ($is_admin) { ?>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
  	<? } ?>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('country_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($territories as $territory): ?>
	<tr>
 	<? if ($is_admin) { ?>
		<td><?php echo h($territory['Territory']['id']); ?>&nbsp;</td>
 	<? } ?>
		<td><?php echo h($territory['Territory']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($territory['Country']['name'], array('controller' => 'countries', 'action' => 'view', $territory['Country']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $territory['Territory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $territory['Territory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $territory['Territory']['id']), null, __('Are you sure you want to delete # %s?', $territory['Territory']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Territory'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
	</ul>
	<? echo $this->Filter->filterForm('Territories', array('legend' => 'Search')); ?>
</div>
