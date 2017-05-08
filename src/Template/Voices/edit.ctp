<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acties') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $voice->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $voice->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Bekijk stemmen'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Bekijk berichten'), ['controller' => 'Messages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nieuw bericht', ['controller' => 'Messages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="voices form large-9 medium-8 columns content">
    <?= $this->Form->create($voice) ?>
    <fieldset>
        <legend><?= __('Bewerk stem') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
