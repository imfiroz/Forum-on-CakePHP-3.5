<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form large-9 medium-8 columns content">
   
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('full_name');
            echo $this->Form->control('email');
            echo $this->Form->control('phone');
			if($auth['User']['role'] == 2):
            echo $this->Form->control('role', ['options' => array( '' => 'Select Role' , 1 => 'Regular User', 2 => 'Admin')]);
			endif;
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    
    <?= $this->Form->postLink(
			__('Delete User Data'),
			['controller' => 'Users', 'action' => 'delete', $user->id],
			['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
		)
	?>
</div>
