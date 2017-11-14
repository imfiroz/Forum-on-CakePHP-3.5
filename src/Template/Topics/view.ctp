<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic $topic
 */
?>

<div class="topics view large-9 medium-8 columns content">
    <h3>Title : <?= h($topic->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $topic->has('user') ? $this->Html->link($topic->user->full_name, ['controller' => 'Users', 'action' => 'view', $topic->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($topic->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($topic->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Visibility') ?></th>
            <td><?= $this->Number->format($topic->visibility) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($topic->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($topic->modified) ?></td>
        </tr>
    </table>
    
    <?= $this->Html->link(__('Add Post on This Topic'), ['controller' => 'Posts', 'action' => 'add',$topic->id]) ?> 
    
    <div class="related">
        <h4><?= __('Related Posts') ?></h4>
        <?php if (!empty($topic->posts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Name') ?></th>
                <th scope="col"><?= __('Body') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($topic->posts as $posts): ?>
            <tr>
                <td><?= h($posts->id) ?></td>
				<?php 
				foreach($users_data as $user_data): 
					if($user_data->id == $posts->user_id): ?>
						<td><?= h($user_data->full_name) ?></td>
				<?php
					endif;
				endforeach;
				 ?>
                <td><?= h($posts->body) ?></td>
                <td><?= h($posts->created) ?></td>
                <td><?= h($posts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Posts', 'action' => 'view', $posts->id]) ?>
                    <?php if($auth['User']['role'] == 2 || $auth['User']['id'] == $posts->user_id ): ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Posts', 'action' => 'edit', $posts->id, $topic->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Posts', 'action' => 'delete', $posts->id, $topic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $posts->id)]) ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
