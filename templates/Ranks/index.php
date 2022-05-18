<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rank[]|\Cake\Collection\CollectionInterface $ranks
 */
?>
<div class="ranks index content">
    <?= $this->Html->link(__('New Rank'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Ranks') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('base') ?></th>
                    <th><?= $this->Paginator->sort('max') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ranks as $rank): ?>
                <tr>
                    <td><?= $this->Number->format($rank->id) ?></td>
                    <td><?= h($rank->name) ?></td>
                    <td><?= $this->Number->format($rank->base) ?></td>
                    <td><?= $this->Number->format($rank->max) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $rank->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rank->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rank->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rank->id)]) ?>
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
