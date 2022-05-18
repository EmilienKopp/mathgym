<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\History $history
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit History'), ['action' => 'edit', $history->student_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete History'), ['action' => 'delete', $history->student_id], ['confirm' => __('Are you sure you want to delete # {0}?', $history->student_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Histories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New History'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="histories view content">
            <h3><?= h($history->Array) ?></h3>
            <table>
                <tr>
                    <th><?= __('Student') ?></th>
                    <td><?= $history->has('student') ? $this->Html->link($history->student->name, ['controller' => 'Students', 'action' => 'view', $history->student->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Rank') ?></th>
                    <td><?= $history->has('rank') ? $this->Html->link($history->rank->name, ['controller' => 'Ranks', 'action' => 'view', $history->rank->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($history->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated') ?></th>
                    <td><?= h($history->updated) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
