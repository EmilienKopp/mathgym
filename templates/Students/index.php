<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student[]|\Cake\Collection\CollectionInterface $students
 */
?>
<div class="students index content">
    <?= $this->Html->link(__('New Student'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Students') ?></h3>
    <div class="table table-striped table-hover">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('rank_id') ?></th>
                    <th class="actions"><?= __('Tracker') ?></th>
                    <th><?= $this->Paginator->sort('worksheets_count') ?></th>
                    <th><?= $this->Paginator->sort('perfects_count') ?></th>
                    <th><?= $this->Paginator->sort('accuracy_rate') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $this->Html->link(__($student->name), ['action' => 'view', $student->id]) ?></td>
                    <td><?= $student->has('rank') ? $this->Html->link($student->rank->name, ['controller' => 'Ranks', 'action' => 'view', $student->rank->id]) : '' ?></td>
                    <td><?= $this->Html->link(__('See Results'),['controller' => 'results', 'action' => 'view', $student->id], ['class' => 'button']) ?></td>
                    <td><?= $student->worksheets_count === null ? '' : $this->Number->format($student->worksheets_count) ?></td>
                    <td><?= $student->perfects_count === null ? '' : $this->Number->format($student->perfects_count) ?></td>
                    <td><?= $student->accuracy_rate === null ? '' : $student->accuracy_rate ?> %</td>
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
