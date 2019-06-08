<div class="territories view">
<h2><?php  echo __('Territory'); ?></h2>
	<dl>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($territory['Territory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($territory['Country']['name'], array('controller' => 'countries', 'action' => 'view', $territory['Country']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Territory'), array('action' => 'edit', $territory['Territory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Territory'), array('action' => 'delete', $territory['Territory']['id']), null, __('Are you sure you want to delete # %s?', $territory['Territory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Territories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Territory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Types'); ?></h3>
	<?php if (!empty($territory['Type'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Start Year'); ?></th>
		<th><?php echo __('End Year'); ?></th>
		<th><?php echo __('Mint Mark'); ?></th>
		<th><?php echo __('Commemorative'); ?></th>
		<th><?php echo __('Error'); ?></th>
		<th><?php echo __('Country Id'); ?></th>
		<th><?php echo __('Territory Id'); ?></th>
		<th><?php echo __('Emission Id'); ?></th>
		<th><?php echo __('Denomination Id'); ?></th>
		<th><?php echo __('Km'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Image'); ?></th>
		<th><?php echo __('Diameter'); ?></th>
		<th><?php echo __('Weight'); ?></th>
		<th><?php echo __('Thickness'); ?></th>
		<th><?php echo __('Mintage'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($territory['Type'] as $type): ?>
		<tr>
			<td><?php echo $type['id']; ?></td>
			<td><?php echo $type['value']; ?></td>
			<td><?php echo $type['start_year']; ?></td>
			<td><?php echo $type['end_year']; ?></td>
			<td><?php echo $type['mint_mark']; ?></td>
			<td><?php echo $type['commemorative']; ?></td>
			<td><?php echo $type['error']; ?></td>
			<td><?php echo $type['country_id']; ?></td>
			<td><?php echo $type['territory_id']; ?></td>
			<td><?php echo $type['emission_id']; ?></td>
			<td><?php echo $type['denomination_id']; ?></td>
			<td><?php echo $type['km']; ?></td>
			<td><?php echo $type['comment']; ?></td>
			<td><?php echo $type['image']; ?></td>
			<td><?php echo $type['diameter']; ?></td>
			<td><?php echo $type['weight']; ?></td>
			<td><?php echo $type['thickness']; ?></td>
			<td><?php echo $type['mintage']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'types', 'action' => 'view', $type['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'types', 'action' => 'edit', $type['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'types', 'action' => 'delete', $type['id']), null, __('Are you sure you want to delete # %s?', $type['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
