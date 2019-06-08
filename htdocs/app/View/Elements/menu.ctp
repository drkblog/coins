<ul class="pdMenu" id="mainMenu">
<? if (AuthComponent::user('id')) { ?>
    <li><?php echo $this->Html->link('Home', '/coins'); ?></li>
    <li><?php echo $this->Html->link('Coins', '/coins'); ?>
    <li><?php echo $this->Html->link('Types', '/types'); ?>
        <ul>
            <li><?php echo $this->Html->link('Missing types', '/types/missing'); ?></li>
        </ul>
        <div class="clear"></div>
    </li>
    <li><?php echo $this->Html->link('Configuration', ''); ?>
        <ul>
            <li><?php echo $this->Html->link('Grades', '/grades'); ?></li>
            <li><?php echo $this->Html->link('Denominations', '/denominations'); ?></li>
            <li><?php echo $this->Html->link('Emissions', '/emissions'); ?></li>
            <li><?php echo $this->Html->link('Countries', '/countries'); ?></li>
            <li><?php echo $this->Html->link('Territories', '/territories'); ?></li>
        </ul>
        <div class="clear"></div>
    </li>
<? } else { ?>
    <li><?php echo $this->Html->link('Home', '/'); ?></li>
<? } ?>
<? if (AuthComponent::user('group_id') == GRP_ADMIN) { ?>
    <li><?php echo $this->Html->link('Users', '/users'); ?>
        <ul>
            <li><?php echo $this->Html->link('Groups', '/groups'); ?></li>
        </ul>
        <div class="clear"></div>
<? } ?>
<? if (AuthComponent::user('group_id') == GRP_VIEWER) { ?>
    <li><?php echo $this->Html->link('Catalog', array('controller' => 'users', 'action' => 'catalog')); ?>
<? } ?>
    <li><?php echo $this->Html->link('Help', '/pages/help'); ?>
<? if (AuthComponent::user('id')) { ?>
    <li><?php echo $this->Html->link('Logout', '/users/logout'); ?>
<? } else { ?>
    <li><?php echo $this->Html->link('Login', '/users/login'); ?>
<? } ?>
</ul>
