<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Answers Controller
 *
 * @property \App\Model\Table\AnswersTable $Answers
 */
class AnswersController extends AppController
{
    
    public function custom()
    {
        $q = $this->Answers->find('latestAnswersFromLatestQuestions', ['election_id' => 2]);
        debug($q->toArray());
        $this->render(false);
    }
    
    public function logs() {
        $q = $this->Answers->find();
        $q
            ->contain('Users')
            ->contain('Questions')
            ->limit(10)
            ->order(['Answers.id' => 'desc']);
        debug($q);
        $this->set('answers', $q);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Questions']
        ];
        $answers = $this->paginate($this->Answers);

        $this->set(compact('answers'));
        $this->set('_serialize', ['answers']);
    }

    /**
     * View method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $answer = $this->Answers->get($id, [
            'contain' => ['Users', 'Questions']
        ]);

        $this->set('answer', $answer);
        $this->set('_serialize', ['answer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $answer = $this->Answers->newEntity();
        if ($this->request->is('post')) {
            $answer = $this->Answers->patchEntity($answer, $this->request->data);
            if ($this->Answers->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The answer could not be saved. Please, try again.'));
            }
        }
        $users = $this->Answers->Users->find('list', ['limit' => 200]);
        $questions = $this->Answers->Questions->find('list', ['limit' => 200]);
        $this->set(compact('answer', 'users', 'questions'));
        $this->set('_serialize', ['answer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $answer = $this->Answers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $answer = $this->Answers->patchEntity($answer, $this->request->data);
            if ($this->Answers->save($answer)) {
                $this->Flash->success(__('The answer has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The answer could not be saved. Please, try again.'));
            }
        }
        $users = $this->Answers->Users->find('list', ['limit' => 200]);
        $questions = $this->Answers->Questions->find('list', ['limit' => 200]);
        $this->set(compact('answer', 'users', 'questions'));
        $this->set('_serialize', ['answer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Answer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $answer = $this->Answers->get($id);
        if ($this->Answers->delete($answer)) {
            $this->Flash->success(__('The answer has been deleted.'));
        } else {
            $this->Flash->error(__('The answer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function quick()
    {
        $userId = 2;
        $q = $this->Answers->Questions->find()
            ->contain(['Answers' => function ($q) use ($userId) {
                return $q->where(['Answers.user_id' => $userId]);
            }]);
        $this->set('questions', $q);
    }
    
    public function answer($questionId, $answerValue)
    {
        $this->request->allowMethod(['post']);
        $userId = 2;
        //comprobar si ya tengo una respuesta
        $answer = $this->Answers->find()
            ->where([
                'Answers.user_id' => $userId,
                'Answers.question_id' => $questionId
                ])
            ->first();
        //si no, la creo
        if (!$answer) {
            $answer = $this->Answers->newEntity([
                'user_id' => $userId,
                'question_id' => $questionId,
                ]);
        }
        //si ya existe o es nueva, actualizo answer
        $answer['answer'] = $answerValue;
        if (!$this->Answers->save($answer)) {
            $this->Flash->error('Answer could not be saved');
        }
        return $this->redirect(['action' => 'quick']);
    }
}
