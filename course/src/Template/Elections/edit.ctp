<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $election->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $election->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Elections'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="elections form large-9 medium-8 columns content">
    <?= $this->Form->create($election) ?>
    <fieldset>
        <legend><?= __('Edit Election') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('year');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
