<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 * @var string[]|\Cake\Collection\CollectionInterface $ranks
 * @var string[]|\Cake\Collection\CollectionInterface $grades
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $student->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $student->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Students'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="students form content">
            <?= $this->Form->create($student) ?>
            <fieldset>
                <legend><?= __('Edit Student') ?></legend>
                <?php
                    echo $this->Form->control('student_number');
                    echo $this->Form->control('name');
                    echo $this->Form->control('rank_id', ['options' => $ranks, 'empty' => true]);
                    echo $this->Form->control('worksheets_count');
                    echo $this->Form->control('perfects_count');
                    echo $this->Form->control('accuracy_rate');
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->control('grade_id', ['options' => $grades]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
