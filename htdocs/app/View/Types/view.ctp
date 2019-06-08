<div class="types view">
<h2><?php echo __('Type');?></h2>
	<dl>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo $type['Type']['value']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start year'); ?></dt>
		<dd>
			<?php echo $type['Type']['start_year']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End year'); ?></dt>
		<dd>
			<?php echo $type['Type']['end_year']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mint Mark'); ?></dt>
		<dd>
			<?php echo $type['Type']['mint_mark']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commemorative'); ?></dt>
		<dd>
			<?php echo $this->Boolean->showIcon($type['Type']['commemorative']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Error'); ?></dt>
		<dd>
			<?php echo $this->Boolean->showIcon($type['Type']['error']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($type['Country']['name'], array('controller' => 'countries', 'action' => 'view', $type['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Territory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($type['Territory']['name'], array('controller' => 'territories', 'action' => 'view', $type['Territory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Emission'); ?></dt>
		<dd>
			<?php echo $this->Html->link($type['Emission']['name'], array('controller' => 'emissions', 'action' => 'view', $type['Emission']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Denomination'); ?></dt>
		<dd>
			<?php echo $this->Html->link($type['Denomination']['name'], array('controller' => 'denominations', 'action' => 'view', $type['Denomination']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Km'); ?></dt>
		<dd>
			<?php echo $type['Type']['km']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo nl2br($type['Type']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Diameter'); ?></dt>
		<dd>
			<?php echo $type['Type']['diameter'].'mm'; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Thickness'); ?></dt>
		<dd>
			<?php echo $type['Type']['thickness'].'mm'; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo $type['Type']['weight'].'g'; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<img src="<?=$this->Coin->getImagePath('Type', $type);?>" alt="" />	
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Type'), array('action' => 'edit', $type['Type']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Type'), array('action' => 'delete', $type['Type']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $type['Type']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Emissions'), array('controller' => 'emissions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emission'), array('controller' => 'emissions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Denominations'), array('controller' => 'denominations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Denomination'), array('controller' => 'denominations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Coins'), array('controller' => 'coins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Add Coin'), array('controller' => 'coins', 'action' => 'add', $type['Type']['id'])); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Coins');?></h3>
	<?php if (!empty($type['Coin'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Label'); ?></th>
		<th><?php echo __('Year'); ?></th>
		<th><?php echo __('Mint mark'); ?></th>
		<th><?php echo __('Grade'); ?></th>
		<th><?php echo __('Image'); ?></th>
		<th><?php echo __('Restored'); ?></th>
		<th><?php echo __('Cleaned'); ?></th>
		<th><?php echo __('Dirty'); ?></th>
		<th><?php echo __('Damaged'); ?></th>
		<th><?php echo __('Possible Error'); ?></th>
		<th><?php echo __('For sale'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Bought for'); ?></th>
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
			<td><?php echo $coin['Coin']['label'];?></td>
			<td><?php echo $coin['Coin']['year'];?></td>
			<td><?php echo $coin['Coin']['mint_mark'];?></td>
			<td><?php echo $coin['Grade']['name'];?></td>
      <td><img src="<?=$this->Coin->getImagePath('Coin', $coin, true);?>" alt="" />&nbsp;</td>
      <td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['restored']); ?>&nbsp;</td>
      <td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['cleaned']); ?>&nbsp;</td>
      <td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['dirty']); ?>&nbsp;</td>
      <td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['damaged']); ?>&nbsp;</td>
      <td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['possible_error']); ?>&nbsp;</td>
      <td class="centred"><?php echo $this->Boolean->showIcon($coin['Coin']['for_sale']); ?>&nbsp;</td>
      <td><?php echo ($show_value || $coin['Coin']['for_sale'])?$coin['Coin']['value']:'---.--'; ?>&nbsp;</td>
      <td><?php echo ($show_value)?$coin['Coin']['bought_for']:'---.--'; ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'coins', 'action' => 'view', $coin['Coin']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'coins', 'action' => 'edit', $coin['Coin']['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'coins', 'action' => 'delete', $coin['Coin']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $coin['Coin']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Add Coin'), array('controller' => 'coins', 'action' => 'add', $type['Type']['id']));?> </li>
		</ul>
	</div>
</div>
