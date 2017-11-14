<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic $topic
 */
?>
<div class="topics form large-9 medium-8 columns content">
    <?= $this->Form->create($topic) ?>
    <fieldset>
        <legend><?= __('Add Topic') ?></legend>
        <?php 
			//echo $users_data;
		
		?>
        <?php
			if($auth['User']['role'] == 2):
            echo $this->Form->control('user_id', ['options' => $users]);
			echo $this->Form->control('Visibity',['options' => array( 'empty' => 'Set Visiblity', 1 => 'Visible', 2 => 'Hidden')]);
			else:
			echo $this->Form->control('user_id', ['options' => array( $auth['User']['id'] => $auth['User']['full_name'] )]);
			endif;
            echo $this->Form->control('title');
			
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
