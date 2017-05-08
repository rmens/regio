<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acties') ?></li>
        <li><?= $this->Html->link(__('Nieuw bericht'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Bekijk stemmen'), ['controller' => 'Voices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nieuwe stem'), ['controller' => 'Voices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messages index large-9 medium-8 columns content">
    <h3><?= __('Berichten') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('voice_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_played') ?></th>
                <th scope="col"><?= $this->Paginator->sort('times_planned') ?></th>
                <th scope="col" class="actions"><?= __('Acties') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
            <tr>
                <td><?= $this->Number->format($message->id) ?></td>
                <td><?= h($message->status) ?></td>
                <td><?= h($message->name) ?></td>
                <td><?= $message->has('voice') ? $this->Html->link($message->voice->name, ['controller' => 'Voices', 'action' => 'view', $message->voice->id]) : '' ?></td>
                <td><?= h($message->start_date) ?></td>
                <td><?= h($message->end_date) ?></td>
                <td><?= h($message->created) ?></td>
                <td><?= h($message->last_played) ?></td>
                <td><?= $this->Number->format($message->times_planned) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('🔎'), ['action' => 'view', $message->id]) ?>
                    <?= $this->Html->link(__('✏️'), ['action' => 'edit', $message->id]) ?>
                    <?= $this->Form->postLink(__('❌'), ['action' => 'delete', $message->id], ['confirm' => __('Weet je zeker dat je # {0} wil verwijderen?', $message->id)]) ?>
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
