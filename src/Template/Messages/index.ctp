<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Message'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Voices'), ['controller' => 'Voices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Voice'), ['controller' => 'Voices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messages index large-9 medium-8 columns content">
    <h3><?= __('Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('path') ?></th>
                <th scope="col"><?= $this->Paginator->sort('voice_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('monday') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tuesday') ?></th>
                <th scope="col"><?= $this->Paginator->sort('wednesday') ?></th>
                <th scope="col"><?= $this->Paginator->sort('thursday') ?></th>
                <th scope="col"><?= $this->Paginator->sort('friday') ?></th>
                <th scope="col"><?= $this->Paginator->sort('saturday') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sunday') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ends') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('times_planned') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
            <tr>
                <td><?= $this->Number->format($message->id) ?></td>
                <td><?= h($message->name) ?></td>
                <td><?= h($message->path) ?></td>
                <td><?= $message->has('voice') ? $this->Html->link($message->voice->name, ['controller' => 'Voices', 'action' => 'view', $message->voice->id]) : '' ?></td>
                <td><?= h($message->start_date) ?></td>
                <td><?= h($message->end_date) ?></td>
                <td><?= h($message->monday) ?></td>
                <td><?= h($message->tuesday) ?></td>
                <td><?= h($message->wednesday) ?></td>
                <td><?= h($message->thursday) ?></td>
                <td><?= h($message->friday) ?></td>
                <td><?= h($message->saturday) ?></td>
                <td><?= h($message->sunday) ?></td>
                <td><?= h($message->created) ?></td>
                <td><?= h($message->ends) ?></td>
                <td><?= h($message->active) ?></td>
                <td><?= $this->Number->format($message->times_planned) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $message->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $message->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
