<?php
declare(strict_types=1);

namespace App\Controller;

use App\Tools\VerboseReturn;
use App\Model\Table\ResultsTable;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StudentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ranks', 'Grades', 'Histories'],
        ];
        $students = $this->paginate($this->Students);
        $this->set(compact('students'));
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => ['Ranks', 'Grades', 'Results', 'Histories'],
        ]);
        $histories = $this->Students->Ranks->find()
          ->select(['ranks.id','ranks.name'])
          ->where(['Histories.student_id IS ' => $id])
          ->leftJoinWith('Histories')
          ->all();
      $options = $histories->map(function ($value, $key) {
            return [
                'value' => $value->id,
                'text' => $value->name,
            ];
        });
        debug($options);
        $this->set(compact('student','histories','options'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $student = $this->Students->newEmptyEntity();
        if ($this->request->is('post')) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                $insertResult = $this->getTableLocator()->get('Results')
                                ->createManyForStudentAndRank($student->id, $student->rank_id+1);
                if($insertResult->isSuccess) {
                    $this->Flash->info(__('{0} results were created for student {1} at rank {2}.',
                                            $insertResult->actualCount,
                                            $student->name,
                                            $student->rank_id
                                        ));
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $ranks = $this->Students->Ranks->find('list', ['limit' => 200])->all();
        $grades = $this->Students->Grades->find('list', ['limit' => 200])->all();
        $this->set(compact('student', 'ranks', 'grades'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $student = $this->Students->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student could not be saved. Please, try again.'));
        }
        $ranks = $this->Students->Ranks->find('list', ['limit' => 200])->all();
        $grades = $this->Students->Grades->find('list', ['limit' => 200])->all();
        $this->set(compact('student', 'ranks', 'grades'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
