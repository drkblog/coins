<?php
$this->Html->scriptStart(array('inline' => false));
?>
$( document ).ready(function() {
  $('#CoinCountryId').change(function() {
    $.ajax({
      dataType: "json",
      type: "POST",
      evalScripts: true,
      url: '<?php echo Router::url(array('controller'=>'emissions', 'action'=>'for_country', 'ext' => 'json'));?>',
      data: ({country:$(this).val()}),
      success: function (data, textStatus){
        $("#CoinEmissionId").find('option').remove();
        $("#CoinEmissionId").append('<option value></option>');
        $.each(data, function(key, value) {
            $("#CoinEmissionId").append('<option value=' + key + '>' + value + '</option>');
        });
      }
    });
  });
  $('#CoinEmissionId').change(function() {
    $.ajax({
      dataType: "json",
      type: "POST",
      evalScripts: true,
      url: '<?php echo Router::url(array('controller'=>'types', 'action'=>'for_emission', 'ext' => 'json'));?>',
      data: ({emission:$(this).val()}),
      success: function (data, textStatus) {
        $("#CoinTypeId").find('option').remove();
        $("#CoinTypeId").append('<option value></option>');
        $.each(data, function(key, value) {
            $("#CoinTypeId").append('<option value=' + key + '>' + value + '</option>');
        });
      }
    });
  });
});
<?php
$this->Html->scriptEnd();
?>
<div class="types form">
<?php echo $this->Form->create('Coin', array('action' => 'changeType'));?>
	<fieldset>
 		<legend><?php echo __('Change type'); ?></legend>
	<?php
		echo $this->Form->input('country_id', array('type'=>'select', 'empty' => true));
		echo $this->Form->input('emission_id', array('type'=>'select', 'empty' => true));
		//echo $this->Ajax->observeField('CoinEmissionId', array('url' => '/types/for_emission', 'update' => 'CoinTypeId'));
		echo $this->Form->input('type_id');
		echo $this->Form->input('id', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

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
