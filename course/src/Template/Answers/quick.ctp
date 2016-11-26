<?php
echo '<table>';
echo $this->Html->tableHeaders([
    __('Title'),
    __('Answer'),
    __('Action')
    ]);
$rows = [];
foreach ($questions as $question) {
    $answerValue = '-';
    if (isset($question->answers[0]->answer)) {
        $answerValue = __('NO');
        if ($question->answers[0]->answer) {
            $answerValue = __('YES');
        }
    }
    $postLinkYes = $this->Form->postLink(__('YES'), [
        'action' => 'answer',
        $question->id,
        1
        ], [
            'confirm' => __('Are you sure?')
            ]);
    $postLinkNo = $this->Form->postLink(__('NO'), [
        'action' => 'answer',
        $question->id,
        0
        ]);
    $rows[] = [
        $question->title,
        $answerValue,
        $postLinkYes . ' / ' . $postLinkNo
        ];
}
echo $this->Html->tableCells($rows);
echo '</table>';