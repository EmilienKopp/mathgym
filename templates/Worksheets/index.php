<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Worksheet[]|\Cake\Collection\CollectionInterface $worksheets
 */
?>
<div class="worksheets index content">
    <?= $this->Html->link(__('New Worksheet'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Worksheets') ?></h3>
    <div class="table table-striped table-hover">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('subrank.rank.name')?></th>
                    <th><?= $this->Paginator->sort('subrank_id') ?></th>
                    <th><?= $this->Paginator->sort('link') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($worksheets as $worksheet) : ?>
                <tr>
                    <td><?= $this->Number->format($worksheet->id) ?></td>
                    <td><?= $worksheet->subrank->has('rank') ? $this->Html->link($worksheet->subrank->rank->name, ['controller' => 'Ranks', 'action' => 'view', $worksheet->subrank->rank->id]) : '' ?></td>
                    <td><?= $worksheet->has('subrank') ? $this->Html->link($worksheet->subrank->id, ['controller' => 'Subranks', 'action' => 'view', $worksheet->subrank->id]) : '' ?></td>
                    <td><?= h($worksheet->link) ?></td>
                    <td><?= h($worksheet->created) ?></td>
                    <td><?= h($worksheet->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $worksheet->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $worksheet->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $worksheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $worksheet->id)]) ?>
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
