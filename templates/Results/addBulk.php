<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Worksheets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="worksheets form content">
            <?= $this->Form->create(null, ['url' => ['action' => 'seed']]) ?>
            <fieldset>
                <legend><?= __('Add Worksheet') ?></legend>
                <?php
                    echo $this->Form->control('rank_id', ['options' => $ranks]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
