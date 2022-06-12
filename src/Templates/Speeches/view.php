<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Speech $speech
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Speech'), ['action' => 'edit', $speech->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Speech'), ['action' => 'delete', $speech->id], ['confirm' => __('Are you sure you want to delete # {0}?', $speech->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Speeches'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Speech'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="speeches view content">
            <h3><?= h($speech->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($speech->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($speech->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Speaker') ?></th>
                    <td><?= $speech->has('speaker') ? $this->Html->link($speech->speaker->name, ['controller' => 'Speakers', 'action' => 'view', $speech->speaker->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($speech->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($speech->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($speech->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($speech->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Time Start') ?></th>
                    <td><?= h($speech->date_time_start) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Time Stop') ?></th>
                    <td><?= h($speech->date_time_stop) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($speech->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
