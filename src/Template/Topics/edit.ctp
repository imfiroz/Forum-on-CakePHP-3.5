<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic $topic
 */
?>
<div class="topics form large-9 medium-8 columns content">
    <?= $this->Form->create($topic) ?>
    <fieldset>
        <legend><?= __('Edit Topic') ?></legend>
        <?php
			
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('title');
            echo $this->Form->control('visibility', ['options' => array( 1 => 'Visible', 2 => 'Hidden')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <?= $this->Form->postLink(
                __('Delete This Topic'),
                ['action' => 'delete', $topic->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $topic->id)]
            )
    ?>
</div>
