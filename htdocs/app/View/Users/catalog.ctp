<div class="users index">
	<h2><?php echo __('Catalogs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('Selected');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	  <td><?php echo $this->Boolean->showIcon($user['User']['id'] == $this->Session->read('ViewCatalog')); ?>&nbsp;</td>
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Select catalog'), array('action' => 'select', $user['User']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Home'), array('controller' => 'pages', 'action' => 'home')); ?></li>
	</ul>
</div>