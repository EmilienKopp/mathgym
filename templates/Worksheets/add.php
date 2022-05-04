<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Worksheet $worksheet
 * @var \Cake\Collection\CollectionInterface|string[] $subranks
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
            <?= $this->Form->create($worksheet) ?>
            <fieldset>
                <legend><?= __('Add Worksheet') ?></legend>
                <?php
                    echo $this->Form->control('subrank_id', ['options' => $subranks]);
                    echo $this->Form->control('link');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
