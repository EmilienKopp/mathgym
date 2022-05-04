<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subrank[]|\Cake\Collection\CollectionInterface $subranks
 */
?>
<div class="subranks index content">
    <?= $this->Html->link(__('New Subrank'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Subranks') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('rank_id') ?></th>
                    <th><?= $this->Paginator->sort('numwithin') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('updated') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subranks as $subrank): ?>
                <tr>
                    <td><?= $this->Number->format($subrank->id) ?></td>
                    <td><?= $subrank->has('rank') ? $this->Html->link($subrank->rank->name, ['controller' => 'Ranks', 'action' => 'view', $subrank->rank->id]) : '' ?></td>
                    <td><?= $this->Number->format($subrank->numwithin) ?></td>
                    <td><?= h($subrank->created) ?></td>
                    <td><?= h($subrank->updated) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $subrank->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subrank->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subrank->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subrank->id)]) ?>
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
