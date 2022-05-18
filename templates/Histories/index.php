<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\History[]|\Cake\Collection\CollectionInterface $histories
 */
?>
<div class="histories index content">
    <?= $this->Html->link(__('New History'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Histories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('student_id') ?></th>
                    <th><?= $this->Paginator->sort('rank_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('updated') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($histories as $history): ?>
                <tr>
                    <td><?= $history->has('student') ? $this->Html->link($history->student->name, ['controller' => 'Students', 'action' => 'view', $history->student->id]) : '' ?></td>
                    <td><?= $history->has('rank') ? $this->Html->link($history->rank->name, ['controller' => 'Ranks', 'action' => 'view', $history->rank->id]) : '' ?></td>
                    <td><?= h($history->created) ?></td>
                    <td><?= h($history->updated) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $history->student_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $history->student_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $history->student_id], ['confirm' => __('Are you sure you want to delete # {0}?', $history->student_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
