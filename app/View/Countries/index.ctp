<div class="countries index">
	<h2><?php echo __('Countries');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
  	<? if ($is_admin) { ?>
			<th><?php echo $this->Paginator->sort('id');?></th>
  	<? } ?>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($countries as $country):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
 	<? if ($is_admin) { ?>
		<td><?php echo $country['Country']['id']; ?>&nbsp;</td>
 	<? } ?>
		<td><?php echo $country['Country']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $country['Country']['id'])); ?>
			<?php echo $this->Html->link(__('Add territory'), array('controller' => 'territories', 'action' => 'add', $country['Country']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $country['Country']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $country['Country']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $country['Country']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Country'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Territories'), array('controller' => 'territories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Territory'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
	</ul>
	<? echo $this->Filter->filterForm('Contries', array('legend' => 'Search')); ?>
</div>