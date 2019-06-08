<?php echo $this->Html->script('ckeditor/ckeditor', array('inline' => false)); ?>
<?php
$this->Html->scriptStart(array('inline' => false));
?>
$( document ).ready(function() {
  $('#EmissionCountryId').change(function() {
    $.ajax({
      dataType: "html",
      type: "POST",
      evalScripts: true,
      url: '<?php echo Router::url(array('controller'=>'territories', 'action'=>'forCountry'));?>',
      data: ({country:$(this).val()}),
      success: function (data, textStatus){
          $("#EmissionTerritoryId").html(data);
      }
    });
  });
});
<?php
$this->Html->scriptEnd();
?>
<div class="emissions form">
<?php echo $this->Form->create('Emission');?>
	<fieldset>
 		<legend><?php echo __('Edit Emission'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('start_year');
		echo $this->Form->input('end_year');
		echo $this->Fck->ckedit('Emission.description', $this->data['Emission']['description'], array('label' => __('Description')));
		echo $this->Form->input('country_id');
		echo $this->Form->input('territory_id', array('empty' => array(0 => '')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Emission.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Emission.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Emissions'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
	</ul>
</div>