<div class="grades index">
	<h2><?php echo __('Grades');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<? if ($is_admin) { ?>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('position');?></th>
  	<? } ?>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('acronym');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($grades as $grade):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	<? if ($is_admin) { ?>
		<td><?php echo $grade['Grade']['id']; ?>&nbsp;</td>
		<td><?php echo $grade['Grade']['position']; ?>&nbsp;</td>
	<? } ?>
		<td><?php echo $grade['Grade']['name']; ?>&nbsp;</td>
		<td><?php echo $grade['Grade']['acronym']; ?>&nbsp;</td>
		<td><?php echo $grade['Grade']['description']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $grade['Grade']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $grade['Grade']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $grade['Grade']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $grade['Grade']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Grade'), array('action' => 'add')); ?></li>
	</ul>
</div>