<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Worksheet $worksheet
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Worksheet'), ['action' => 'edit', $worksheet->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Worksheet'), ['action' => 'delete', $worksheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $worksheet->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Worksheets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Worksheet'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="worksheets view content">
            <h3><?= h($worksheet->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Subrank') ?></th>
                    <td><?= $worksheet->has('subrank') ? $this->Html->link($worksheet->subrank->id, ['controller' => 'Subranks', 'action' => 'view', $worksheet->subrank->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Link') ?></th>
                    <td><?= h($worksheet->link) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($worksheet->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($worksheet->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($worksheet->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Results') ?></h4>
                <?php if (!empty($worksheet->results)) : ?>
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
                        <?php foreach ($worksheet->results as $results) : ?>
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
