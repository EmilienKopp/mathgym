<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\History $history
 * @var string[]|\Cake\Collection\CollectionInterface $students
 * @var string[]|\Cake\Collection\CollectionInterface $ranks
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $history->student_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $history->student_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Histories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="histories form content">
            <?= $this->Form->create($history) ?>
            <fieldset>
                <legend><?= __('Edit History') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
