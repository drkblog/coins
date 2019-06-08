<?php
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
		echo $this->Html->css('mobile');
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
		<? if (isset($username)) { ?>
		  <span id="username"><?php echo $username; ?></span>
		<? } ?>
		<span id="copyright">
			DRK Coin Catalog Beta - 2013-2015<br />
			DRK Open source software<br />
			<? echo $this->Html->link('Terms of Service', '/pages/terms'); ?>
		</span>
		</div>
	</div>
</body>
</html>
