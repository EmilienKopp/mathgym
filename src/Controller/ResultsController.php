<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Results Controller
 *
 * @property \App\Model\Table\ResultsTable $Results
 * @method \App\Model\Entity\Result[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResultsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Worksheets'],
        ];
        $results = $this->paginate($this->Results);

        $this->set(compact('results'));
    }

    /**
     * View method
     *
     * @param string|null $id Result id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($studentId = null)
    {
       /* $result = $this->Results->get($id, [
        *    'contain' => ['Students', 'Worksheets'],
        *]);
        **/
        $studentRankQuery = $this->getTableLocator()->get('Students')->find()
            ->select(['rank_id'])
            ->where(['id IS' => 1]);
        $rank = $studentRankQuery->first();
        $rankID = $rank->rank_id;

        $subranksQuery = $this->getTableLocator()->get('Subranks')->find()
            ->select(['id'])
            ->where(['rank_id IS' => $rankID+1]);
        $subranks = $subranksQuery->all()->toArray();


        $worksheetsQuery = $this->getTableLocator()->get('Worksheets')->find()
            ->select(['id'])
            ->where([
                'subrank_id >=' => $subranks[0]->id,
                'subrank_id <=' => $subranks[4]->id,
            ]);
        $studentRankWorksheets = $worksheetsQuery->all()->toArray();

        $resultsQuery = $this->Results->find()
                                ->where([
                                    'worksheet_id >= ' => $studentRankWorksheets[0]->id,
                                    'worksheet_id <= ' => end($studentRankWorksheets)->id,
                            ]);

        $resultsForStudent = $resultsQuery->all();

        $formattedResultsArray = [
            
        ];


        $this->set(compact('resultsForStudent','subranks','studentRankWorksheets'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $result = $this->Results->newEmptyEntity();
        if ($this->request->is('post')) {
            $result = $this->Results->patchEntity($result, $this->request->getData());
            if ($this->Results->save($result)) {
                $this->Flash->success(__('The result has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The result could not be saved. Please, try again.'));
        }
        $students = $this->Results->Students->find('list', ['limit' => 200])->all();
        $worksheets = $this->Results->Worksheets->find('list', ['limit' => 200])->all();
        $this->set(compact('result', 'students', 'worksheets'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Result id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $result = $this->Results->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $result = $this->Results->patchEntity($result, $this->request->getData());
            if ($this->Results->save($result)) {
                $this->Flash->success(__('The result has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The result could not be saved. Please, try again.'));
        }
        $students = $this->Results->Students->find('list', ['limit' => 200])->all();
        $worksheets = $this->Results->Worksheets->find('list', ['limit' => 200])->all();
        $this->set(compact('result', 'students', 'worksheets'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Result id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $result = $this->Results->get($id);
        if ($this->Results->delete($result)) {
            $this->Flash->success(__('The result has been deleted.'));
        } else {
            $this->Flash->error(__('The result could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
