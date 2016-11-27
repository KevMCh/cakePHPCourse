<?php
echo '<table>';
echo $this -> Html -> tableHeaders([
    __('Title'),
    __('Number of Answer:'),
    __('Yes'),
    __('No')
    ]);
    
if(count($questions) != 0){
    foreach ($questions as $question) {
        $answerValue = '-';
        
        $answerYes = 0;
        $answerNo = 0;
        $numAnswer = 0;
        if (isset($question -> answers)) {
            $numAnswer = count($question -> answers);
    
            for($i = 0; $i < $numAnswer; $i++){
                if ($question -> answers[$i] -> answer) {
                    $answerValue = __('Yes');
                    $answerYes ++;
                } else {
                    if (!($question -> answers[$i] -> answer)) {
                        $answerValue = __('No');
                        $answerNo ++;
                    }
                }
            }
        }
        
        $percentageYes = 0;
        $percentageNo = 0;
        if($numAnswer != 0){
            $percentageYes = ($answerYes / $numAnswer) * 100;
            $percentageNo = ($answerNo / $numAnswer) * 100;
        }
    
        $rows[] = [
            $question -> title,
            $numAnswer,
            $percentageYes . "%",
            $percentageNo . "%"
        ];
    }
    
    echo $this -> Html -> tableCells($rows);
}
echo '</table>';