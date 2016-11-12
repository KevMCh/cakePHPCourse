<h2>
    <?php
    $msgTitulo = 'La pregunta: {0} tiene {1} respuestas:';
    echo __($msgTitulo, $question->title, count($question->answers));
    ?>
</h2>
<table>
    <tr>
        <td>
            Usuario
        </td>
        <td>
            Respuesta
        </td>
    </tr>
    <?php
    foreach ($question->answers as $answer) {
        echo '<tr>';
        echo '<td>' . $answer->user->first_name . '</td>';
        echo '<td>' . $answer->display_answer . '</td>';
        echo '</tr>';
    }
    ?>
</table>