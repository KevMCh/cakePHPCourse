<?php
$this->layout = 'bootstrap';
echo $this->Html->tag('h1', __('Últimas 10 respuestas'));

$tableContents = '';

$rows = [];
foreach ($answers as $answer) {
    $rows[] = [
        h($answer->user->first_name),
        h($answer->answer),
        h($answer->question->title),
    ];
}
$tableContents .= $this->Html->tableHeaders([
    [__('Usuario') => [
        'class' => 'c1',
        ]],
    __('Respuesta'),
    __('Titulo')
    ]);
$tableContents .= $this->Html->tableCells($rows);

echo $this->Html->tag('table', $tableContents, [
    'class' => 'table table-striped table-responsive',
    ]);