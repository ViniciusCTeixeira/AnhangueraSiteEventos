<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SpeecheParticipant[]|\Cake\Collection\CollectionInterface $speecheParticipants
 */
?>
<div class="speecheParticipants index content">
    <?= $this->Html->link(__('New Speeche Participant'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Speeche Participants') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('cert') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('speeche_id') ?></th>
                    <th><?= $this->Paginator->sort('participant_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($speecheParticipants as $speecheParticipant): ?>
                <tr>
                    <td><?= $this->Number->format($speecheParticipant->id) ?></td>
                    <td><?= h($speecheParticipant->created) ?></td>
                    <td><?= h($speecheParticipant->modified) ?></td>
                    <td><?= h($speecheParticipant->cert) ?></td>
                    <td><?= $this->Number->format($speecheParticipant->status) ?></td>
                    <td><?= $speecheParticipant->has('speech') ? $this->Html->link($speecheParticipant->speech->title, ['controller' => 'Speeches', 'action' => 'view', $speecheParticipant->speech->id]) : '' ?></td>
                    <td><?= $speecheParticipant->has('participant') ? $this->Html->link($speecheParticipant->participant->name, ['controller' => 'Participants', 'action' => 'view', $speecheParticipant->participant->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $speecheParticipant->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $speecheParticipant->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $speecheParticipant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $speecheParticipant->id)]) ?>
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
