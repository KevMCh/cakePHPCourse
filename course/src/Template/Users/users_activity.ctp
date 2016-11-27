<?php
echo '<h1> Users </h1><hr>';
if(isset($users)){
    foreach ($users as $user) {
        echo "<strong>Nombre: </strong>" . $user -> first_name;
            
            if(isset($user -> answers)){
                for($i = 0; $i < count($user -> answers); $i++){
                    echo "<ul>";
                    echo "<li>";
                    
                    echo "<strong> Pregunta: </strong> " .
                         $user -> answers[$i] -> question_id . "<br>";

                    echo "<strong> Respuesta: </strong> " ;
                    if ($user -> answers[$i] -> answer) {
                        echo __('Yes');
                    } else {
                        if (!($user -> answers[$i] -> answer)) {
                            echo __('No');
                        }
                    }
                    
                    /*if(isset($user -> answers)){
                        echo "<h6> Respuestas: </h6>";
                        for($j = 0; $j < count($user -> answers); $j++){
                            echo "<ul>";
                            echo "<ol>";
                            if ($question -> answers[$i] -> answer) {
                                echo __('Yes');
                            } else {
                                if (!($question -> answers[$i] -> answer)) {
                                    echo __('No');
                                }
                            }   
                            echo "</ol>";
                            echo "</ul>";
                        }
                    }*/
                    
                    echo "</li>";
                    echo "</ul>";
                }
            }
        echo '<br><br>';
    }
}
