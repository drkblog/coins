<?php echo $this->Html->script('ckeditor/ckeditor', array('inline' => false)); ?>
<?php
$this->Html->scriptStart(array('inline' => false));
?>
$( document ).ready(function() {
  $('#TypeCountryId').change(function() {
    $.ajax({
      dataType: "json",
      type: "POST",
      evalScripts: true,
      url: '<?php echo Router::url(array('controller'=>'emissions', 'action'=>'for_country', 'ext' => 'json'));?>',
      data: ({country:$(this).val()}),
      success: function (data, textStatus){
        $("#TypeEmissionId").find('option').remove();
        $("#TypeEmissionId").append('<option value></option>');
        $.each(data, function(key, value) {
            $("#TypeEmissionId").append('<option value=' + key + '>' + value + '</option>');
        });
      }
    });
    $.ajax({
      dataType: "json",
      type: "POST",
      evalScripts: true,
      url: '<?php echo Router::url(array('controller'=>'territories', 'action'=>'for_country', 'ext' => 'json'));?>',
      data: ({country:$(this).val()}),
      success: function (data, textStatus) {
        $("#TypeTerritoryId").find('option').remove();
        $("#TypeTerritoryId").append('<option value></option>');
        $.each(data, function(key, value) {
            $("#TypeTerritoryId").append('<option value=' + key + '>' + value + '</option>');
        });
      }
    });
  });
});
<?php
$this->Html->scriptEnd();
?>
<div class="types form">
<?php echo $this->Form->create('Type');?>
	<fieldset>
 		<legend><?php echo __('New type preloaded with this values'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('value', array('div' => array('class' => 'half-width')));
		echo $this->Form->input('denomination_id', array('div' => array('class' => 'half-width')));
		echo $this->Form->input('start_year', array('div' => array('class' => 'third-width')));
		echo $this->Form->input('end_year', array('div' => array('class' => 'third-width')));
		echo $this->Form->input('mint_mark', array('div' => array('class' => 'third-width')));
		echo $this->Form->input('commemorative');
		echo $this->Form->input('error');
		echo $this->Form->input('country_id', array('div' => array('class' => 'third-width')));
		echo $this->Form->input('territory_id', array('empty' => true, 'div' => array('class' => 'third-width')));
		echo $this->Form->input('emission_id', array('div' => array('class' => 'third-width')));
		echo $this->Form->input('km');
		echo $this->Fck->ckedit('Type.comment', $this->data['Type']['comment'], array('label' => __('Comment')));
		echo $this->Form->input('weight', array('div' => array('class' => 'third-width')));
		echo $this->Form->input('diameter', array('div' => array('class' => 'third-width')));
		echo $this->Form->input('thickness', array('div' => array('class' => 'third-width')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Type.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Type.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Types'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Emissions'), array('controller' => 'emissions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emission'), array('controller' => 'emissions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Denominations'), array('controller' => 'denominations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Denomination'), array('controller' => 'denominations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Coins'), array('controller' => 'coins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coin'), array('controller' => 'coins', 'action' => 'add')); ?> </li>
	</ul>
</div>
