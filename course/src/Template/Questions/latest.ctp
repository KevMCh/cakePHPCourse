<?php
$this->layout = 'bootstrap';
echo $this->Html->tag('h1', __('Últimas preguntas'));

$tableContents = '';

$rows = [];
foreach ($questions as $question) {
    $rows[] = [
        h($question->user->first_name),
        h($question->title),
        $question->created->nice(),
    ];
}
$tableContents .= $this->Html->tableHeaders([
    [__('Usuario') => [
        'class' => 'c1',
        'title' => 'hey',
        ]],
    __('Titulo'),
    __('Fecha')
    ]);
$tableContents .= $this->Html->tableCells($rows);

echo $this->Html->tag('table', $tableContents, [
    'class' => 'table table-striped table-responsive',
    ]);