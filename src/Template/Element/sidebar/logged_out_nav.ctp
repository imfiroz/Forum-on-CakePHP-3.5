<?php
/*
*Custom side menus when session is not set
*/
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        
        <?php if($auth): ?>
		<li><?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout']);?></li>
        <?php else: ?>
        <li><?= $this->Html->link(__('Login'), ['controller' => 'users', 'action' => 'login']);?></li>
        <?php endif; ?>
        <li><?= $this->Html->link(__('Register'), ['controller' => 'users', 'action' => 'signup']);?></li>
        <li><?= $this->Html->link(__('New Topic'), ['controller' => 'Topics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Forgot Password'), ['controller' => 'users', 'action' => 'Forgot-password']);?></li>
        <li><?= $this->Html->link(__('About Us'), ['controller' => 'users', 'action' => 'about_us']);?></li>
        <li><?= $this->Html->link(__('Contact Us'), ['controller' => 'users', 'action' => 'contect_us']);?></li>
    </ul>
</nav>