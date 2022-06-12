<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventParticipant $eventParticipant
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Event Participant'), ['action' => 'edit', $eventParticipant->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Event Participant'), ['action' => 'delete', $eventParticipant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventParticipant->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Event Participants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Event Participant'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="eventParticipants view content">
            <h3><?= h($eventParticipant->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Cert') ?></th>
                    <td><?= h($eventParticipant->cert) ?></td>
                </tr>
                <tr>
                    <th><?= __('Event') ?></th>
                    <td><?= $eventParticipant->has('event') ? $this->Html->link($eventParticipant->event->title, ['controller' => 'Events', 'action' => 'view', $eventParticipant->event->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Participant') ?></th>
                    <td><?= $eventParticipant->has('participant') ? $this->Html->link($eventParticipant->participant->name, ['controller' => 'Participants', 'action' => 'view', $eventParticipant->participant->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($eventParticipant->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($eventParticipant->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($eventParticipant->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($eventParticipant->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
