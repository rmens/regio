<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Bekijk berichten'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Bekijk stemmen'), ['controller' => 'Voices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Stem toevoegen'), ['controller' => 'Voices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messages form large-9 medium-8 columns content">
    <?= $this->Form->create($message, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Bericht toevoegen') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->file('upload');
            echo $this->Form->control('voice_id', ['options' => $voices, 'empty' => true]);
            echo $this->Form->control('start_date', ['default' => date('Y-m-d')]);
            echo $this->Form->control('end_date', ['default' => date('Y-m-d')]);
            echo $this->Form->control('monday');
            echo $this->Form->control('tuesday');
            echo $this->Form->control('wednesday');
            echo $this->Form->control('thursday');
            echo $this->Form->control('friday');
            echo $this->Form->control('saturday');
            echo $this->Form->control('sunday');
			echo "<hr>";
            echo $this->Form->control('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Toevoegen')) ?>
    <?= $this->Form->end() ?>
</div>
