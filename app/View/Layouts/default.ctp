<?php
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->Html->css('cake.generic');
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('coin');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><a href="http://www.drk.com.ar">DRK Coin Catalog - Beta</a></h1>
			<?php echo $this->element('menu', array()); ?>
		</div>
		<div id="content">
  		<div><h4><? echo $this->Session->flash(); ?></h4></div>		
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		  <?
		    $username = $this->Session->read('Username');
		    $catalog = (AuthComponent::user('group_id') == GRP_VIEWER)?(' - '.__('Catalog').': '.$this->Session->read('Catalog')):'';
		    if (isset($username)) { 
		  ?>
		    <span id="username"><?php echo $username.$catalog; ?></span>
		  <? } ?>
		  <span id="copyright">
		  <span>DRK Coin Catalog Beta - 2013-2015 - DRK Open source software - </span>
			<? echo $this->Html->link('Terms of Service', '/pages/terms'); ?>
			<span>
		</div>
	</div>
</body>
</html>
