<div class="coins index">
	<h2><?php echo __('Coins');?></h2>
	<p>Listing <?php echo $this->Paginator->params['paging']['Coin']['count']; ?> coins with total value of: <?php echo ($show_value)?$total:'---.--'; ?></p>
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
			<th><?php echo $this->Paginator->sort('label');?></th>
			<th><?php echo $this->Paginator->sort('type_id');?></th>
			<th><?php echo $this->Paginator->sort('year');?></th>
			<th><?php echo $this->Paginator->sort('mint_mark');?></th>
			<th><?php echo $this->Paginator->sort('grade_id');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>
			<th><?php echo $this->Paginator->sort('restored');?></th>
			<th><?php echo $this->Paginator->sort('cleaned');?></th>
			<th><?php echo $this->Paginator->sort('dirty');?></th>
			<th><?php echo $this->Paginator->sort('damaged');?></th>
			<th><?php echo $this->Paginator->sort('possible_error');?></th>
			<th><?php echo $this->Paginator->sort('for_sale');?></th>
			<th><?php echo $this->Paginator->sort('value');?></th>
			<th><?php echo $this->Paginator->sort('bought_for');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($coins as $coin):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	<? if ($is_admin) { ?>
		<td><?php echo $coin['Coin']['id']; ?>&nbsp;</td>
	<? } ?>
		<td><?php echo $this->Html->link($coin['Coin']['label'],
		                array('controller' => 'coins','action' => 'deposit',
		                  str_replace('.', '-', preg_replace('/\.[^\.]+$/', '', $coin['Coin']['label'])))); ?>&nbsp;</td>
		<td nowrap="true">
			<?php echo $this->Html->link($this->Coin->getCoinTypeName($coin),
						      array('controller' => 'types', 
							    'action' => 'view',
							    $coin['Type']['id']),
						      array('title' => 'km#'.$coin['Type']['km'].', '.$coin['Type']['Emission']['name'].', '.$coin['Type']['comment'])); ?>
		</td>
		<td><?php echo $coin['Coin']['year']; ?>&nbsp;</td>
		<td><?php echo $coin['Coin']['mint_mark']; ?>&nbsp;</td>
		<td class="centred">
			<?php echo $this->Html->link($coin['Grade']['name'], array('controller' => 'grades', 'action' => 'view', $coin['Grade']['id'])); ?>
		</td>
		<td>
		<?php echo $this->Html->image($this->Coin->getImagePath('Coin', $coin, true), array('alt' => '', 'url' => array('action' => 'view', $coin['Coin']['id']))); ?> 
		&nbsp;</td>
		<td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['restored']); ?>&nbsp;</td>
		<td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['cleaned']); ?>&nbsp;</td>
		<td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['dirty']); ?>&nbsp;</td>
		<td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['damaged']); ?>&nbsp;</td>
		<td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['possible_error']); ?>&nbsp;</td>
		<td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['for_sale']); ?>&nbsp;</td>
		<td><?php echo ($show_value || $coin['Coin']['for_sale'])?$coin['Coin']['value']:'---.--'; ?>&nbsp;</td>
		<td><?php echo ($show_value)?$coin['Coin']['bought_for']:'---.--'; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $coin['Coin']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $coin['Coin']['id'])); ?>
			<?php echo $this->Html->link(__('Clone'), array('action' => 'duplicate', $coin['Coin']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $coin['Coin']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $coin['Coin']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Deposit'), array('controller' => 'coins', 'action' => 'deposit')); ?> </li>
		<li><?php echo $this->Html->link(__('Bulk add images'), array('controller' => 'coins', 'action' => 'bulk_images')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grades'), array('controller' => 'grades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grade'), array('controller' => 'grades', 'action' => 'add')); ?> </li>
	</ul>
	<? echo $this->Filter->filterForm('Coins', array('legend' => 'Search')); ?>
</div>
