<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acties') ?></li>
        <li><?= $this->Html->link(__('Bewerk bericht'), ['action' => 'edit', $message->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Verwijder bericht'), ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id)]) ?> </li>
        <li><?= $this->Html->link(__('Bekijk berichtens'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nieuw bericht'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Bekijk stemmen'), ['controller' => 'Voices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nieuwe stem'), ['controller' => 'Voices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="messages view large-9 medium-8 columns content">
    <h3><?= h($message->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($message->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Path') ?></th>
            <td><?= h($message->path) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Voice') ?></th>
            <td><?= $message->has('voice') ? $this->Html->link($message->voice->name, ['controller' => 'Voices', 'action' => 'view', $message->voice->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($message->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Times Planned') ?></th>
            <td><?= $this->Number->format($message->times_planned) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($message->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($message->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($message->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last played') ?></th>
            <td><?= h($message->last_played) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Monday') ?></th>
            <td><?= $message->monday ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tuesday') ?></th>
            <td><?= $message->tuesday ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Wednesday') ?></th>
            <td><?= $message->wednesday ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Thursday') ?></th>
            <td><?= $message->thursday ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Friday') ?></th>
            <td><?= $message->friday ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Saturday') ?></th>
            <td><?= $message->saturday ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sunday') ?></th>
            <td><?= $message->sunday ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $message->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
