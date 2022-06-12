<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SpeecheParticipant $speecheParticipant
 * @var string[]|\Cake\Collection\CollectionInterface $speeches
 * @var string[]|\Cake\Collection\CollectionInterface $participants
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $speecheParticipant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $speecheParticipant->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Speeche Participants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="speecheParticipants form content">
            <?= $this->Form->create($speecheParticipant) ?>
            <fieldset>
                <legend><?= __('Edit Speeche Participant') ?></legend>
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
