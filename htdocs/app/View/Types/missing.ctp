<div class="types index">
	<h2><?php echo __('Missing types');?></h2>
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
	<table cellpadding="0" cellspacing="0">
	<tr>
		<? if ($is_admin) { ?>
			<th><?php echo $this->Paginator->sort('id');?></th>
  	<? } ?>
			<th><?php echo $this->Paginator->sort('value');?></th>
			<th><?php echo $this->Paginator->sort('denomination_id');?></th>
			<th><?php echo $this->Paginator->sort('start_year');?></th>
			<th><?php echo $this->Paginator->sort('end_year');?></th>
			<th><?php echo $this->Paginator->sort('mint_mark');?></th>
			<th><?php echo $this->Paginator->sort('km');?></th>
			<th><?php echo $this->Paginator->sort('Comm.', 'commemorative');?></th>
			<th><?php echo $this->Paginator->sort('error');?></th>
			<th><?php echo $this->Paginator->sort('country_id');?></th>
			<th><?php echo $this->Paginator->sort('territory_id');?></th>
			<th><?php echo $this->Paginator->sort('emission_id');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($types as $type):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	<? if ($is_admin) { ?>
		<td><?php echo $type['Type']['id']; ?>&nbsp;</td>
 	<? } ?>
		<td class="right"><?php echo $this->NumFormat->specialDecimal($type['Type']['value']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($type['Denomination']['name'], array('controller' => 'denominations', 'action' => 'view', $type['Denomination']['id'])); ?>
		</td>
		<td><?php echo $type['Type']['start_year']; ?>&nbsp;</td>
		<td><?php echo $type['Type']['end_year']; ?>&nbsp;</td>
		<td><?php echo $type['Type']['mint_mark']; ?>&nbsp;</td>
		<td><?php echo $type['Type']['km']; ?>&nbsp;</td>
		<td class="centred"><?php echo $this->Boolean->showIcon($type['Type']['commemorative']); ?>&nbsp;</td>
		<td class="centred"><?php echo $this->Boolean->showIcon($type['Type']['error']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($type['Country']['name'], array('controller' => 'countries', 'action' => 'view', $type['Country']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($type['Territory']['name'], array('controller' => 'territories', 'action' => 'view', $type['Territory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($type['Emission']['name'], array('controller' => 'emissions', 'action' => 'view', $type['Emission']['id'])); ?>
		</td>
		<td><img src="<?=$this->Coin->getImagePath('Type', $type, true);?>" alt="" />&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $type['Type']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Bulk add image'), array('action' => 'bulk_images')); ?></li>
		<li><?php echo $this->Html->link(__('List all types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Coins'), array('controller' => 'coins', 'action' => 'index')); ?> </li>
	</ul>
	<? echo $this->Filter->filterForm('Types', array('legend' => 'Search')); ?>
</div>
