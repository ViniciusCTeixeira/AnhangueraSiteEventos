<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventParticipant[]|\Cake\Collection\CollectionInterface $eventParticipants
 */
?>
<div class="eventParticipants index content">
    <?= $this->Html->link(__('New Event Participant'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Event Participants') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('cert') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('event_id') ?></th>
                    <th><?= $this->Paginator->sort('participant_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventParticipants as $eventParticipant): ?>
                <tr>
                    <td><?= $this->Number->format($eventParticipant->id) ?></td>
                    <td><?= h($eventParticipant->created) ?></td>
                    <td><?= h($eventParticipant->modified) ?></td>
                    <td><?= h($eventParticipant->cert) ?></td>
                    <td><?= $this->Number->format($eventParticipant->status) ?></td>
                    <td><?= $eventParticipant->has('event') ? $this->Html->link($eventParticipant->event->title, ['controller' => 'Events', 'action' => 'view', $eventParticipant->event->id]) : '' ?></td>
                    <td><?= $eventParticipant->has('participant') ? $this->Html->link($eventParticipant->participant->name, ['controller' => 'Participants', 'action' => 'view', $eventParticipant->participant->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $eventParticipant->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $eventParticipant->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eventParticipant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventParticipant->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
