<?php
namespace App\Controller;

use App\Controller\AppController;

class ListQuestionsController extends AppController
{
    public function index()
    {
        $this -> loadModel('Questions');
        $this -> loadModel('Answers');
        $query = $this -> Questions
                        -> find('lastUserCreated')
                        -> limit(3)
                        -> contain('Answers');

        //debug($query -> toArray());
                        
        $datos = array ($query -> count());
        $position = 0;
        
        foreach ($query as $questions) {
            $datos [$position] = array(
                "title" => $questions -> title,
                "answers" => $questions -> answers
                );
                
            $position++;
        }   
        debug($datos);
    }
}