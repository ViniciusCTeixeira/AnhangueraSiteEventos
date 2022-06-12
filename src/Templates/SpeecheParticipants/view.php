<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SpeecheParticipant $speecheParticipant
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Speeche Participant'), ['action' => 'edit', $speecheParticipant->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Speeche Participant'), ['action' => 'delete', $speecheParticipant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $speecheParticipant->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Speeche Participants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Speeche Participant'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="speecheParticipants view content">
            <h3><?= h($speecheParticipant->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Cert') ?></th>
                    <td><?= h($speecheParticipant->cert) ?></td>
                </tr>
                <tr>
                    <th><?= __('Speech') ?></th>
                    <td><?= $speecheParticipant->has('speech') ? $this->Html->link($speecheParticipant->speech->title, ['controller' => 'Speeches', 'action' => 'view', $speecheParticipant->speech->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Participant') ?></th>
                    <td><?= $speecheParticipant->has('participant') ? $this->Html->link($speecheParticipant->participant->name, ['controller' => 'Participants', 'action' => 'view', $speecheParticipant->participant->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($speecheParticipant->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($speecheParticipant->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($speecheParticipant->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($speecheParticipant->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
