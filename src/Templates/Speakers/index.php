<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Speaker[]|\Cake\Collection\CollectionInterface $speakers
 */
?>
<div class="speakers index content">
    <?= $this->Html->link(__('New Speaker'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Speakers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('phone') ?></th>
                    <th><?= $this->Paginator->sort('img') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($speakers as $speaker): ?>
                <tr>
                    <td><?= $this->Number->format($speaker->id) ?></td>
                    <td><?= h($speaker->created) ?></td>
                    <td><?= h($speaker->modified) ?></td>
                    <td><?= h($speaker->name) ?></td>
                    <td><?= h($speaker->email) ?></td>
                    <td><?= h($speaker->phone) ?></td>
                    <td><?= h($speaker->img) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $speaker->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $speaker->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $speaker->id], ['confirm' => __('Are you sure you want to delete # {0}?', $speaker->id)]) ?>
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
