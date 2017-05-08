<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acties') ?></li>
        <li><?= $this->Html->link(__('Bewerk stem'), ['action' => 'edit', $voice->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Verwijder stem'), ['action' => 'delete', $voice->id], ['confirm' => __('Are you sure you want to delete # {0}?', $voice->id)]) ?> </li>
        <li><?= $this->Html->link(__('Bekijk stemmen'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nieuwe stem'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Bekijk berichten'), ['controller' => 'Messages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nieuw bericht'), ['controller' => 'Messages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="voices view large-9 medium-8 columns content">
    <h3><?= h($voice->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($voice->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($voice->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Ingesproken berichten') ?></h4>
        <?php if (!empty($voice->messages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Last Played') ?></th>
                <th scope="col"><?= __('Times Planned') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($voice->messages as $messages): ?>
            <tr>
                <td><?= h($messages->id) ?></td>
                <td><?= h($messages->name) ?></td>
                <td><?= h($messages->start_date) ?></td>
                <td><?= h($messages->end_date) ?></td>
                <td><?= h($messages->created) ?></td>
                <td><?= h($messages->last_played) ?></td>
                <td><?= h($messages->times_planned) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Messages', 'action' => 'view', $messages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Messages', 'action' => 'edit', $messages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Messages', 'action' => 'delete', $messages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $messages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
