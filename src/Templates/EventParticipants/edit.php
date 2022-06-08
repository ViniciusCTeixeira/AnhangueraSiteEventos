<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventParticipant $eventParticipant
 * @var string[]|\Cake\Collection\CollectionInterface $participants
 * @var string[]|\Cake\Collection\CollectionInterface $events
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $eventParticipant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $eventParticipant->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Event Participants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="eventParticipants form content">
            <?= $this->Form->create($eventParticipant) ?>
            <fieldset>
                <legend><?= __('Edit Event Participant') ?></legend>
                <?php
                    echo $this->Form->control('participant_id', ['options' => $participants]);
                    echo $this->Form->control('event_id', ['options' => $events]);
                    echo $this->Form->control('cert');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
