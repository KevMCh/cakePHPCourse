<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Questions Tag'), ['action' => 'edit', $questionsTag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Questions Tag'), ['action' => 'delete', $questionsTag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionsTag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Questions Tags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Questions Tag'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questionsTags view large-9 medium-8 columns content">
    <h3><?= h($questionsTag->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $questionsTag->has('question') ? $this->Html->link($questionsTag->question->title, ['controller' => 'Questions', 'action' => 'view', $questionsTag->question->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tag') ?></th>
            <td><?= $questionsTag->has('tag') ? $this->Html->link($questionsTag->tag->name, ['controller' => 'Tags', 'action' => 'view', $questionsTag->tag->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($questionsTag->id) ?></td>
        </tr>
    </table>
</div>
