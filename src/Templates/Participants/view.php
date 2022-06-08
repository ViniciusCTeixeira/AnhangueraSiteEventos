<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Participant $participant
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Participant'), ['action' => 'edit', $participant->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Participant'), ['action' => 'delete', $participant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $participant->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Participants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Participant'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="participants view content">
            <h3><?= h($participant->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($participant->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($participant->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($participant->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cpf') ?></th>
                    <td><?= $this->Number->format($participant->cpf) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ra') ?></th>
                    <td><?= $this->Number->format($participant->ra) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= $this->Number->format($participant->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($participant->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($participant->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Event Participants') ?></h4>
                <?php if (!empty($participant->event_participants)) : ?>
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
                        <?php foreach ($participant->event_participants as $eventParticipants) : ?>
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
