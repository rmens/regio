<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acties') ?></li>
        <li><?= $this->Html->link(__('Bekijk stemmen'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Bekijk berichten'), ['controller' => 'Messages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nieuw bericht'), ['controller' => 'Messages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="voices form large-9 medium-8 columns content">
    <?= $this->Form->create($voice, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Stem toevoegen') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->file('upload');
            echo $this->Form->control('namejinglemixpoint');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Toevoegen')) ?>
    <?= $this->Form->end() ?>
</div>
