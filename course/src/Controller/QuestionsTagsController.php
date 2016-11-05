<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * QuestionsTags Controller
 *
 * @property \App\Model\Table\QuestionsTagsTable $QuestionsTags
 */
class QuestionsTagsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Questions', 'Tags']
        ];
        $questionsTags = $this->paginate($this->QuestionsTags);

        $this->set(compact('questionsTags'));
        $this->set('_serialize', ['questionsTags']);
    }

    /**
     * View method
     *
     * @param string|null $id Questions Tag id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $questionsTag = $this->QuestionsTags->get($id, [
            'contain' => ['Questions', 'Tags']
        ]);

        $this->set('questionsTag', $questionsTag);
        $this->set('_serialize', ['questionsTag']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $questionsTag = $this->QuestionsTags->newEntity();
        if ($this->request->is('post')) {
            $questionsTag = $this->QuestionsTags->patchEntity($questionsTag, $this->request->data);
            if ($this->QuestionsTags->save($questionsTag)) {
                $this->Flash->success(__('The questions tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The questions tag could not be saved. Please, try again.'));
            }
        }
        $questions = $this->QuestionsTags->Questions->find('list', ['limit' => 200]);
        $tags = $this->QuestionsTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('questionsTag', 'questions', 'tags'));
        $this->set('_serialize', ['questionsTag']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Questions Tag id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $questionsTag = $this->QuestionsTags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $questionsTag = $this->QuestionsTags->patchEntity($questionsTag, $this->request->data);
            if ($this->QuestionsTags->save($questionsTag)) {
                $this->Flash->success(__('The questions tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The questions tag could not be saved. Please, try again.'));
            }
        }
        $questions = $this->QuestionsTags->Questions->find('list', ['limit' => 200]);
        $tags = $this->QuestionsTags->Tags->find('list', ['limit' => 200]);
        $this->set(compact('questionsTag', 'questions', 'tags'));
        $this->set('_serialize', ['questionsTag']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Questions Tag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $questionsTag = $this->QuestionsTags->get($id);
        if ($this->QuestionsTags->delete($questionsTag)) {
            $this->Flash->success(__('The questions tag has been deleted.'));
        } else {
            $this->Flash->error(__('The questions tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
