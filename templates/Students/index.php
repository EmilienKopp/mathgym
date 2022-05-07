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
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('student_number') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('rank_id') ?></th>
                    <th class="actions"><?= __('Tracker') ?></th>
                    <th><?= $this->Paginator->sort('worksheets_count') ?></th>
                    <th><?= $this->Paginator->sort('perfects_count') ?></th>
                    <th><?= $this->Paginator->sort('accuracy_rate') ?></th>
                    <th><?= $this->Paginator->sort('grade_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $this->Number->format($student->id) ?></td>
                    <td><?= h($student->student_number) ?></td>
                    <td><?= h($student->name) ?></td>
                    <td><?= $student->has('rank') ? $this->Html->link($student->rank->name, ['controller' => 'Ranks', 'action' => 'view', $student->rank->id]) : '' ?></td>
                    <td><?= $this->Html->link(__('See Results'),['controller' => 'results', 'action' => 'view', $student->id], ['class' => 'button']) ?></td>
                    <td><?= $student->worksheets_count === null ? '' : $this->Number->format($student->worksheets_count) ?></td>
                    <td><?= $student->perfects_count === null ? '' : $this->Number->format($student->perfects_count) ?></td>
                    <td><?= $student->accuracy_rate === null ? '' : $this->Number->format($student->accuracy_rate) ?></td>

                    <td><?= $student->has('grade') ? $this->Html->link($student->grade->name, ['controller' => 'Grades', 'action' => 'view', $student->grade->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $student->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?>
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
