<?php
/*
*Regular User Navigations
*/
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Topics'), ['controller' => 'Topics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Topic'), ['controller' => 'Topics', 'action' => 'add']) ?></li>
    </ul>
</nav>
