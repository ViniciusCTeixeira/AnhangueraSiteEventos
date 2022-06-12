<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Speech $speech
 * @var \Cake\Collection\CollectionInterface|string[] $speakers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Speeches'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="speeches form content">
            <?= $this->Form->create($speech) ?>
            <fieldset>
                <legend><?= __('Add Speech') ?></legend>
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
