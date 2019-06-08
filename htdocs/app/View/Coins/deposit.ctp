<?php
echo $this->Html->css('jquery-ui', array('inline' => false));
$this->Html->script('jquery-ui/jquery-ui', array('inline' => false));
if (AuthComponent::user('group_id') != GRP_VIEWER) {
  $this->Html->scriptStart(array('inline' => false));
?>
$( document ).ready(function() {
  $("#CoinDepositForm").submit(function( event ) {
    event.preventDefault();
    window.location = '<?php echo Router::url(array('controller'=>'coins', 'action'=>'deposit'));?>/'+$("#CoinDock").val().replace('.', '-');
  });
  $(".draggable").draggable({
    revert: function(event, ui) {
      $(this).data("ui-draggable").originalPosition = {
          top : 0,
          left : 0
      };
      return !event;
    }
    });
  $( ".droppable-busy" ).droppable({
    disabled: true
  });
  $( ".droppable" ).droppable({
    disabled: false,
    tolerance: 'intersect',
    drop: function( event, ui ) {
        var drop_p = $(this).offset();
        var drag_p = ui.draggable.offset();
        var left_end = drop_p.left - drag_p.left + 1;
        var top_end = drop_p.top - drag_p.top + 1;
        ui.draggable.animate({
            top: '+=' + top_end,
            left: '+=' + left_end
        });
      cid = $(ui.draggable).attr('id');
      window.location = '<?php echo Router::url(array('controller'=>'coins', 'action'=>'move'));?>/'+cid+'/'+$(this).attr('id');
    }
  });
});
<?php
  $this->Html->scriptEnd();
}
?>
<div class="deposit form">
  <?php echo $this->Form->create('Coin', array('default' => 'false'));?>
  <?php echo $this->Form->input('dock', array('value' => $dock)); ?>
  <?php echo $this->Form->end(__('Show'));?>
	<p>Listing <?php echo $count ?> coins<?php echo ($show_value)?" with total value of: $total":''; ?></p>


<? if ($dock != null && AuthComponent::user('public_catalog') == 1) { ?>
    <?php echo $this->Html->image('/img/share.png', array('class' => 'share', 'alt' => 'Permanent public link', 'url' => array('controller' => 'coins', 'action' => 'deposit', str_replace('.', '-', $dock), AuthComponent::user('id')))); ?>
<? } ?>	
	<h2><?php echo __('Coins');?></h2>
	<table class="deposit" cellpadding="0" cellspacing="0">
	<?php
  for($r = 1; $r <= $max_row; ++$r) {
?>
	<tr>
<?php
  	for($c = 'A'; $c <= $max_col; ++$c) {
	    $coin = @$map_coins[$c][$r];
	    if (isset($coin)) {
	?>
		<td class="coin droppable-busy">
    <h1><?php echo "$c$r"; ?></h1>
		<div class="draggable" id="<?php echo $coin['Coin']['id']; ?>">
      <img src="<?=$this->Coin->getImagePath('Coin', $coin);?>" alt="" class="mediumcoin" />
      <p class="detail"><?php echo $this->Html->link($this->Coin->getCoinName($coin), array('action' => 'view', $coin['Coin']['id'])); ?><br />
      <?php echo $coin['Type']['Country']['name'].' ['.$coin['Type']['start_year'].'-'.$coin['Type']['end_year'].'] '.$coin['Type']['mint_mark']; ?><br />
      <?php echo 'km#'.$coin['Type']['km'].', '.$coin['Type']['Emission']['name']; ?><br /></p>
    </div>
		</td>
<?php
      }
      else {
	?>
		<td class="coin droppable" id="<?php echo "$c$r"; ?>">
		<h1><?php echo "$c$r"; ?></h1>
		</td>
<?php
      }
    } //for
?>
	</tr>
<?php
  } //for
?>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Coins'), array('controller' => 'coins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Bulk add images'), array('controller' => 'coins', 'action' => 'bulk_images')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grades'), array('controller' => 'grades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grade'), array('controller' => 'grades', 'action' => 'add')); ?> </li>
	</ul>
</div>
