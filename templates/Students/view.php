<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Student'), ['action' => 'edit', $student->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Student'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Students'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Student'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="students view content">
            <h3><?= h($student->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Student Number') ?></th>
                    <td><?= h($student->student_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($student->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rank') ?></th>
                    <td><?= $student->has('rank') ? $this->Html->link($student->rank->name, ['controller' => 'Ranks', 'action' => 'view', $student->rank->id]) : '' ?></td>
                    <td><?= $this->Form->create($student) ?>
                    <?= $this->Form->select('rank_id', $histories) ?>
                    <?= $this->Form->end() ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($student->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Grade') ?></th>
                    <td><?= $student->has('grade') ? $this->Html->link($student->grade->name, ['controller' => 'Grades', 'action' => 'view', $student->grade->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($student->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Worksheets Count') ?></th>
                    <td><?= $student->worksheets_count === null ? '' : $this->Number->format($student->worksheets_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Perfects Count') ?></th>
                    <td><?= $student->perfects_count === null ? '' : $this->Number->format($student->perfects_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Accuracy Rate') ?></th>
                    <td><?= $student->accuracy_rate === null ? '' : $this->Number->format($student->accuracy_rate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($student->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($student->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Results') ?></h4>
                <?php if (!empty($student->results)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Student Id') ?></th>
                            <th><?= __('Worksheet Id') ?></th>
                            <th><?= __('Result') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Updated') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($student->results as $results) : ?>
                        <tr>
                            <td><?= h($results->student_id) ?></td>
                            <td><?= h($results->worksheet_id) ?></td>
                            <td><?= h($results->result) ?></td>
                            <td><?= h($results->created) ?></td>
                            <td><?= h($results->updated) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Results', 'action' => 'view', $results->student_id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Results', 'action' => 'edit', $results->student_id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Results', 'action' => 'delete', $results->student_id], ['confirm' => __('Are you sure you want to delete # {0}?', $results->student_id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
