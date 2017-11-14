<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>

<div class="posts form large-9 medium-8 columns content">
    <?= $this->Form->create($post) ?>
    <fieldset>
        <legend><?= __('Edit Post') ?></legend>
        <?php
            echo $this->Form->control('topic_id', ['options' => $topics]);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('body');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
	<?= $this->Form->postLink(
			__('Delete Post'),
			['action' => 'delete', $post->id],
			['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]
		)
	?> 
</div>
