<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Result[]|\Cake\Collection\CollectionInterface $results
 */
?>
<div class="results index content">
    <?= $this->Html->link(__('New Result'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Results') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('student_id') ?></th>
                    <th><?= $this->Paginator->sort('worksheet_id') ?></th>
                    <th><?= $this->Paginator->sort('result') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('updated') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                <tr>
                    <td><?= $result->has('student') ? $this->Html->link($result->student->name, ['controller' => 'Students', 'action' => 'view', $result->student->id]) : '' ?></td>
                    <td><?= $result->has('worksheet') ? $this->Html->link($result->worksheet->id, ['controller' => 'Worksheets', 'action' => 'view', $result->worksheet->id]) : '' ?></td>
                    <td><?= h($result->result) ?></td>
                    <td><?= h($result->created) ?></td>
                    <td><?= h($result->updated) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $result->student_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $result->student_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $result->student_id], ['confirm' => __('Are you sure you want to delete # {0}?', $result->student_id)]) ?>
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
