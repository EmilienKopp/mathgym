<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subrank $subrank
 * @var \Cake\Collection\CollectionInterface|string[] $ranks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Subranks'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="subranks form content">
            <?= $this->Form->create($subrank) ?>
            <fieldset>
                <legend><?= __('Add Subrank') ?></legend>
                <?php
                    echo $this->Form->control('rank_id', ['options' => $ranks]);
                    echo $this->Form->control('numwithin');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
