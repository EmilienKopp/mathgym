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
            <?= $this->Html->link(__('List Ranks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
        
    <div class="column-responsive column-80">
        <div class="ranks form content">
            <?= $this->Form->create($rank) ?>
            <fieldset>
                <legend><?= __('Add Rank') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('base');
                ?>
            </fieldset>
            <br/>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
            <div class="related">
                <h4><?= __('Existing Ranks') ?></h4>
                <?php if (!empty($ranks)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Rank Name') ?></th>
                            <th><?= __('Base Number') ?></th>
                        </tr>
                        <?php foreach ($ranks as $existingRank) : ?>
                        <tr>
                            <td><?= h($existingRank->name) ?></td>
                            <td><?= h($existingRank->base) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
