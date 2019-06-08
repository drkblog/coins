<div class="emissions index">
	<h2><?php echo __('Emissions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<? if ($is_admin) { ?>
			<th><?php echo $this->Paginator->sort('id');?></th>
  	<? } ?>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('start_year');?></th>
			<th><?php echo $this->Paginator->sort('end_year');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('country_id');?></th>
			<th><?php echo $this->Paginator->sort('territory_id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($emissions as $emission):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	<? if ($is_admin) { ?>
		<td><?php echo $emission['Emission']['id']; ?>&nbsp;</td>
 	<? } ?>
		<td><?php echo $emission['Emission']['name']; ?>&nbsp;</td>
		<td><?php echo $emission['Emission']['start_year']; ?>&nbsp;</td>
		<td><?php echo $emission['Emission']['end_year']; ?>&nbsp;</td>
		<td><?php echo $emission['Emission']['description']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($emission['Country']['name'], array('controller' => 'countries', 'action' => 'view', $emission['Country']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($emission['Territory']['name'], array('controller' => 'territories', 'action' => 'view', $emission['Territory']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $emission['Emission']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $emission['Emission']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $emission['Emission']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $emission['Emission']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
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
		<li><?php echo $this->Html->link(__('New Emission'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
	</ul>
		<? echo $this->Filter->filterForm('Emissions', array('legend' => 'Search')); ?>
</div>