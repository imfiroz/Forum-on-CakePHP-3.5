<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Topic[]|\Cake\Collection\CollectionInterface $topics
 */
?>
<div class="topics index large-9 medium-8 columns content">
    <h3><?= __('Topics') ?></h3>
    <table cellpadding="0" cellspacing="0">
       <?php
			if(empty($auth)):
				$auth= array('User' => NULL, array('role'=> NULL, 'id' => NULL ));
			endif;
		?>
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <?php if($auth['User']['id'] == 1 || empty($auth)): ?>
                <th scope="col"><?= $this->Paginator->sort('visibility') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
				// 1. Only Admin can view all topics
				    foreach ($topics as $topic):
						if($auth['User']['role'] == 2):
			?>
            <tr>
                <td><?= $this->Number->format($topic->id) ?></td>
                <td><?= $topic->has('user') ? $this->Html->link($topic->user->full_name, ['controller' => 'Users', 'action' => 'view', $topic->user->id ]) : '' ?></td>
                <td><?= $this->Html->link( h($topic->title), ['action' => 'view', $topic->id ])?></td>
                <td><?= h($topic->created) ?></td>
                <td><?= h($topic->modified) ?></td>
                <td><?= $this->Number->format($topic->visibility) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $topic->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $topic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $topic->id)]) ?>
                </td>
            </tr>
            <?php 	endif;
				// 2 . Regular users can view only visible topics
					if($auth['User']['role'] == 1 || empty($auth['User']['role'])):
						if($topic->visibility == 1)://checking for visible topics
			?>
      		<tr>
                <td><?= $this->Number->format($topic->id) ?></td>
                <td><?= $topic->has('user') ? $this->Html->link($topic->user->full_name, ['controller' => 'Users', 'action' => 'view', $topic->user->id]) : '' ?></td>
                <td><?= $this->Html->link( h($topic->title), ['action' => 'view', $topic->id])?></td>
                <td><?= h($topic->created) ?></td>
                <td><?= h($topic->modified) ?></td>
                
            </tr>
       		<?php 		endif;
					endif;
				endforeach;
			?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
