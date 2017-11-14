<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>
<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post) ?>
    <fieldset>
        <legend><?= __('Add Post') ?></legend>
    
        <?php
            echo $this->Form->control('topic_id', ['options' => $topics]);
			if($auth['User']['role'] == 2):
            echo $this->Form->control('user_id', ['options' => $users]);
			else:
			echo $this->Form->control('user_id', ['options' => array( $auth['User']['id'] => $auth['User']['full_name'] )]);
			endif;
            echo $this->Form->control('body');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
