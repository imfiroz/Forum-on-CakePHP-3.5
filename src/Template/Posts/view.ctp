<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>
  
<div class="posts view large-9 medium-8 columns content">
    <h3><?= h($post->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Topic') ?></th>
            <td><?= $post->has('topic') ? $this->Html->link($post->topic->title, ['controller' => 'Topics', 'action' => 'view', $post->topic->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $post->has('user') ? $this->Html->link($post->user->id, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($post->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($post->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($post->modified) ?></td>
        </tr>
    </table>
    <?php if($post->user->id == $auth['User']['id'] || $auth['User']['role'] == 2): ?> 
        <?= $this->Html->link(__('Edit Post'), ['action' => 'edit', $post->id]) ?>
        <?= $this->Form->postLink(__('Delete Post'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?> 
    <?php endif;?> 
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($post->body)); ?>
    </div>
</div>
