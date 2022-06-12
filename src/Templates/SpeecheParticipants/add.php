<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SpeecheParticipant $speecheParticipant
 * @var \Cake\Collection\CollectionInterface|string[] $speeches
 * @var \Cake\Collection\CollectionInterface|string[] $participants
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Speeche Participants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="speecheParticipants form content">
            <?= $this->Form->create($speecheParticipant) ?>
            <fieldset>
                <legend><?= __('Add Speeche Participant') ?></legend>
                <?php
                    echo $this->Form->control('cert');
                    echo $this->Form->control('status');
                    echo $this->Form->control('speeche_id', ['options' => $speeches]);
                    echo $this->Form->control('participant_id', ['options' => $participants]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
