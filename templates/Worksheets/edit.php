<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Worksheet $worksheet
 * @var string[]|\Cake\Collection\CollectionInterface $subranks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $worksheet->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $worksheet->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Worksheets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="worksheets form content">
            <?= $this->Form->create($worksheet) ?>
            <fieldset>
                <legend><?= __('Edit Worksheet') ?></legend>
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
