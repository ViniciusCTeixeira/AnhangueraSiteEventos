<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Speech[]|\Cake\Collection\CollectionInterface $speeches
 */
?>
<div class="speeches index content">
    <?= $this->Html->link(__('New Speech'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Speeches') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('date_time_start') ?></th>
                    <th><?= $this->Paginator->sort('date_time_stop') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('speaker_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($speeches as $speech): ?>
                <tr>
                    <td><?= $this->Number->format($speech->id) ?></td>
                    <td><?= h($speech->created) ?></td>
                    <td><?= h($speech->modified) ?></td>
                    <td><?= h($speech->name) ?></td>
                    <td><?= h($speech->title) ?></td>
                    <td><?= h($speech->date_time_start) ?></td>
                    <td><?= h($speech->date_time_stop) ?></td>
                    <td><?= $this->Number->format($speech->status) ?></td>
                    <td><?= $speech->has('speaker') ? $this->Html->link($speech->speaker->name, ['controller' => 'Speakers', 'action' => 'view', $speech->speaker->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $speech->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $speech->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $speech->id], ['confirm' => __('Are you sure you want to delete # {0}?', $speech->id)]) ?>
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
