<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Speech $speech
 * @var string[]|\Cake\Collection\CollectionInterface $speakers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $speech->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $speech->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Speeches'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="speeches form content">
            <?= $this->Form->create($speech) ?>
            <fieldset>
                <legend><?= __('Edit Speech') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('title');
                    echo $this->Form->control('description');
                    echo $this->Form->control('date_time_start');
                    echo $this->Form->control('date_time_stop');
                    echo $this->Form->control('status');
                    echo $this->Form->control('speaker_id', ['options' => $speakers]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
