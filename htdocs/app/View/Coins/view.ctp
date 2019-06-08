<div class="coins view">
<? if (AuthComponent::user('public_catalog') == 1) { ?>
    <?php echo $this->Html->image('/img/share.png', array('class' => 'share', 'alt' => 'Permanent public link', 'url' => array('controller' => 'coins', 'action' => 'view', $coin['Coin']['id'], AuthComponent::user('id')))); ?>
<? } ?>	
<h2><?php echo __('Coin');?></h2>
	<dl>
		<dt><?php echo __('Label'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coin['Coin']['label'],
		                array('controller' => 'coins','action' => 'deposit',
		                  str_replace('.', '-', preg_replace('/\.[^\.]+$/', '', $coin['Coin']['label'])))); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($this->Coin->getCoinTypeName($coin), array('controller' => 'types', 'action' => 'view', $coin['Type']['id'])); ?>
			&nbsp;<br />
			<?php echo $this->Html->para('typeData', nl2br('km'.$coin['Type']['km']."\n".$coin['Type']['Emission']['name']."\n".$coin['Type']['comment']));  ?>
		</dd>
		<dt><?php echo __('Year'); ?></dt>
		<dd>
			<?php echo $coin['Coin']['year']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mint mark'); ?></dt>
		<dd>
			<?php echo $coin['Coin']['mint_mark']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grade'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coin['Grade']['name'], array('controller' => 'grades', 'action' => 'view', $coin['Grade']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo $coin['Coin']['comment']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Restored'); ?></dt>
		<dd>
			<?php echo $this->Boolean->showIcon($coin['Coin']['restored']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cleaned'); ?></dt>
		<dd>
			<?php echo $this->Boolean->showIcon($coin['Coin']['cleaned']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dirty'); ?></dt>
		<dd>
			<?php echo $this->Boolean->showIcon($coin['Coin']['dirty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Damaged'); ?></dt>
		<dd>
			<?php echo $this->Boolean->showIcon($coin['Coin']['damaged']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Possible Error'); ?></dt>
		<dd>
			<?php echo $this->Boolean->showIcon($coin['Coin']['possible_error']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('For sale'); ?></dt>
		<dd>
			<?php echo $this->Boolean->showIcon($coin['Coin']['for_sale']); ?>
			&nbsp;
		</dd>
<?php if ($show_value) { ?>		
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo $coin['Coin']['value']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bought for'); ?></dt>
		<dd>
			<?php echo $coin['Coin']['bought_for']; ?>
			&nbsp;
		</dd>
<?php }
      else if ($coin['Coin']['for_sale']) { ?>
		<dt><?php echo __('Sell for'); ?></dt>
		<dd>
			<?php echo $coin['Coin']['value']; ?>
			&nbsp;
		</dd>
<?php } ?>
    <dt><?php echo __('Image'); ?></dt>
		<dd>
			<img src="<?=$this->Coin->getImagePath('Coin', $coin);?>" alt="" />	
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Coin'), array('action' => 'edit', $coin['Coin']['id'])); ?></li>
		<li><?php echo $this->Html->link(__('Clone'), array('action' => 'duplicate', $coin['Coin']['id'])); ?></li>
		<li><?php echo $this->Html->link(__('Delete Coin'), array('action' => 'delete', $coin['Coin']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $coin['Coin']['id'])); ?></li>
		<li><?php echo $this->Html->link(__('List Coins'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('New Coin'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?></li>
	</ul>
</div>
