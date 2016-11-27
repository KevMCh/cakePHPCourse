<?php
namespace App\Controller;

use App\Controller\AppController;
use \Cake\ORM\Query;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 */
class QuestionsController extends AppController
{
    
    public function detailsLastQuestions() {
        $q = $this -> Questions -> find('detailsLastQuestions')
                   -> contain('Answers');
        
        $question = $q -> toArray();
        $this->set('questions', $question);
    }
    
    public function search (){
        $options = $this -> request -> query;
        $q = $this->Questions->find('search', $options);
        debug($q->toArray());
        $this->render(false);
    }
    
    // Query using contain
    public function answerYes() {
        $q = $this -> Questions -> find();
        $answersFilter = function(Query $query) {
                return $query -> where(['answer' => true]);
            };

        $q
            -> contain(['Answers' => $answersFilter]);
            // -> contain(['Users.Parties' => function(...)])
        debug($q -> toArray());
        $this -> render(false);
    }
    
    // Query with matching
    public function onlyAnswerNo() {
        $q = $this -> Questions -> find();
        $answersFilter = function(Query $query) {
                return $query -> where(['answer' => false]);
            };

        $q
            -> matching('Answers', $answersFilter);
        debug($q -> toArray());
        $this -> render(false);
    }
    
    public function lastUserCreated () {
        /*$q = $this -> Questions -> Users -> find();
        $q
            -> order(['created' => 'desc']);
        debug($q -> first());
        //$q = $this->loadModel('Users')->find();*/
        
        $q = $this->Questions->Users->find('byFirstName', [
            'firstName' => 'first'
            ])
            -> find('latest');
        $q
            -> order(['created' => 'desc']);
        debug($q -> toArray());
        //$q = $this->loadModel('Users')->find();
        
        $this->render(false);
    }
    
    public function review ($userEmail = null){
        $q = $this->Questions->find('latest');

        /*$q = $this -> Questions -> find();
        $q
            /*-> order([
                'Questions.title' => 'asc',
                ]);*/
            /*-> contain('Users')
            -> where([
                'Users.email' => $userEmail
                ]);*/
            
            /*->contain('Users')
            ->contain('Answers')
            ->where(['Users.email' => $userEmail])
            ->where(['Answers.answer' => true]);
            
        debug($q->toArray());
        $this->render(false);

                
        //debug($q -> sql());
        debug($q -> toArray());*/
        
        
        
        $this->render(false);
    }
    
    public function latest() {
        $q = $this->Questions->find();
        $q
            ->contain('Users')
            ->limit(5)
            ->order(['Questions.created' => 'desc']);
        $this->set('questions', $q->toArray());
    }
    
    public function download() {
        
        $this->response->file(ROOT . DS . 'files' . DS . 'file.txt', [
            'name' => 'download.txt',
            'download' => true,
            ]);
            
        return $this -> response;
    }
    
    public function bye () {
        $this -> redirect(['action' => 'hello']);
    }
    
    public function hello ($name = null) {
        
        /*
        // Save Entitys
        $data = [
            'title' => 'q3',
            'user_id' => 2,
            'election_id' => 2
            ];

        $newQuestion = $this->Questions->newEntity($data);
        //newQuestion es un Entity
        $saveResult = $this->Questions->save($newQuestion);
        if (!$saveResult) {
            debug($newQuestion->errors());
        }*/

        // Show 
        $q = $this->Questions->find();
        $q
            ->where(['Questions.id' => 3])
            ->contain(['Users', 'Elections'])
            ->contain('Answers.Users');
        $question = $q->first();
        $this->set('name', $name);
        $this->set('question', $question);
        
        //Change Entities
        /*$q = $this->Questions->find();
        $q
            ->where(['Questions.id' => 3])
            ->contain(['Users', 'Elections'])
            ->contain('Answers.Users');
        $question = $q->first();
        $question->title = 'New title';
        $this->Questions->save($question);
        $this->set('name', $name);
        $this->set('question', $question);*/
    }
    
    

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Elections', 'YesAnswers']
        ];
        $questions = $this->paginate($this->Questions);

        $this->set(compact('questions'));
        $this->set('_serialize', ['questions']);
    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => ['Users', 'Elections', 'Tags', 'Answers']
        ]);

        $this->set('question', $question);
        $this->set('_serialize', ['question']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The question could not be saved. Please, try again.'));
            }
        }
        $users = $this->Questions->Users->find('list', ['limit' => 200]);
        $elections = $this->Questions->Elections->find('list', ['limit' => 200]);
        $tags = $this->Questions->Tags->find('list', ['limit' => 200]);
        $this->set(compact('question', 'users', 'elections', 'tags'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The question could not be saved. Please, try again.'));
            }
        }
        $users = $this->Questions->Users->find('list', ['limit' => 200]);
        $elections = $this->Questions->Elections->find('list', ['limit' => 200]);
        $tags = $this->Questions->Tags->find('list', ['limit' => 200]);
        $this->set(compact('question', 'users', 'elections', 'tags'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
