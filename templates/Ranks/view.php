<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rank $rank
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Rank'), ['action' => 'edit', $rank->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Rank'), ['action' => 'delete', $rank->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rank->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ranks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Rank'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="ranks view content">
            <h3><?= h($rank->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($rank->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($rank->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Base') ?></th>
                    <td><?= $this->Number->format($rank->base) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Students') ?></h4>
                <?php if (!empty($rank->students)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Student Number') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Rank Id') ?></th>
                            <th><?= __('Worksheets Count') ?></th>
                            <th><?= __('Perfects Count') ?></th>
                            <th><?= __('Accuracy Rate') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Grade Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rank->students as $students) : ?>
                        <tr>
                            <td><?= h($students->id) ?></td>
                            <td><?= h($students->student_number) ?></td>
                            <td><?= h($students->name) ?></td>
                            <td><?= h($students->rank_id) ?></td>
                            <td><?= h($students->worksheets_count) ?></td>
                            <td><?= h($students->perfects_count) ?></td>
                            <td><?= h($students->accuracy_rate) ?></td>
                            <td><?= h($students->created) ?></td>
                            <td><?= h($students->modified) ?></td>
                            <td><?= h($students->email) ?></td>
                            <td><?= h($students->password) ?></td>
                            <td><?= h($students->grade_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $students->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Students', 'action' => 'edit', $students->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Students', 'action' => 'delete', $students->id], ['confirm' => __('Are you sure you want to delete # {0}?', $students->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Subranks') ?></h4>
                <?php if (!empty($rank->subranks)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Rank Id') ?></th>
                            <th><?= __('Numwithin') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Updated') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($rank->subranks as $subranks) : ?>
                        <tr>
                            <td><?= h($subranks->id) ?></td>
                            <td><?= h($subranks->rank_id) ?></td>
                            <td><?= h($subranks->numwithin) ?></td>
                            <td><?= h($subranks->created) ?></td>
                            <td><?= h($subranks->updated) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Subranks', 'action' => 'view', $subranks->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Subranks', 'action' => 'edit', $subranks->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subranks', 'action' => 'delete', $subranks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subranks->id)]) ?>
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
