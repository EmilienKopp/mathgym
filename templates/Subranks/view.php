<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subrank $subrank
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Subrank'), ['action' => 'edit', $subrank->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Subrank'), ['action' => 'delete', $subrank->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subrank->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Subranks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Subrank'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="subranks view content">
            <h3><?= h($subrank->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Rank') ?></th>
                    <td><?= $subrank->has('rank') ? $this->Html->link($subrank->rank->name, ['controller' => 'Ranks', 'action' => 'view', $subrank->rank->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($subrank->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Numwithin') ?></th>
                    <td><?= $this->Number->format($subrank->numwithin) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($subrank->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated') ?></th>
                    <td><?= h($subrank->updated) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Worksheets') ?></h4>
                <?php if (!empty($subrank->worksheets)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Subrank Id') ?></th>
                            <th><?= __('Link') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($subrank->worksheets as $worksheets) : ?>
                        <tr>
                            <td><?= h($worksheets->id) ?></td>
                            <td><?= h($worksheets->subrank_id) ?></td>
                            <td><?= h($worksheets->link) ?></td>
                            <td><?= h($worksheets->created) ?></td>
                            <td><?= h($worksheets->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Worksheets', 'action' => 'view', $worksheets->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Worksheets', 'action' => 'edit', $worksheets->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Worksheets', 'action' => 'delete', $worksheets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $worksheets->id)]) ?>
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
