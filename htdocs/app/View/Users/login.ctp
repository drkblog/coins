<?php
$this->Session->flash('auth');
echo $this->Html->tag('span', 'Guest login available using "guest" as username and "demodrk" as password.', array('id' => 'guestlogin'));
echo $this->Form->create('User', array('action' => 'login'));
echo $this->Form->inputs(array(
  'legend' => __('Login'),
  'username',
  'password'
));
echo $this->Html->tag('span', 'By logging into DRK Coin you agree to the ');
echo $this->Html->link('Terms of Service', '/pages/terms');
echo $this->Form->end('Login');
?>

