<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Events'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Event'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="events view content">
            <h3><?= h($event->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($event->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Speaker') ?></th>
                    <td><?= $event->has('speaker') ? $this->Html->link($event->speaker->name, ['controller' => 'Speakers', 'action' => 'view', $event->speaker->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($event->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($event->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($event->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($event->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Time Start') ?></th>
                    <td><?= h($event->date_time_start) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Time Stop') ?></th>
                    <td><?= h($event->date_time_stop) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($event->description)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Event Participants') ?></h4>
                <?php if (!empty($event->event_participants)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Participant Id') ?></th>
                            <th><?= __('Event Id') ?></th>
                            <th><?= __('Cert') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($event->event_participants as $eventParticipants) : ?>
                        <tr>
                            <td><?= h($eventParticipants->id) ?></td>
                            <td><?= h($eventParticipants->created) ?></td>
                            <td><?= h($eventParticipants->modified) ?></td>
                            <td><?= h($eventParticipants->participant_id) ?></td>
                            <td><?= h($eventParticipants->event_id) ?></td>
                            <td><?= h($eventParticipants->cert) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'EventParticipants', 'action' => 'view', $eventParticipants->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'EventParticipants', 'action' => 'edit', $eventParticipants->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'EventParticipants', 'action' => 'delete', $eventParticipants->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventParticipants->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
