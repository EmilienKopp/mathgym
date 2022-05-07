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
    public function obsoleteView($studentId = null)
    {
       /* $result = $this->Results->get($id, [
        *    'contain' => ['Students', 'Worksheets'],
        *]);
        **/
        $students = $this->getTableLocator()->get('Students');
        $search = $this->request->getQuery('search');     
        if ($this->request->is('get') && $search != null) {
            $studentQuery = $students->find('all')
                ->where([
                    'OR' => ['students.name' => $search, 'student_number' => $search ],
                ])
                ->contain(['Ranks']);

            $student = $studentQuery->first();
            $studentId = $student->id;
        }

        $studentRankQuery = $students->find()
            ->where(['students.id IS' => $studentId])
            ->contain('Ranks');

        $rank = $studentRankQuery->first()->rank;
        $studentNextRank = $student->rank->id + 1;

        $resultsQuery = $this->Results->find()
                        ->contain(['Students', 'Worksheets' => ['Subranks']])
                        ->where(['Students.id IS' => $studentId, 'Subranks.rank_id IS' => $studentNextRank]);
        $results = $resultsQuery->all();
        debug($results);
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
        $students = $this->getTableLocator()->get('Students');
        $search = $this->request->getQuery('search');
        $ranks = $this->getTableLocator()->get('Ranks');

        //TODO Implement Student Not Found
        if ($this->request->is('get') && $search != null) {
            $student = $students->findByNameOrId($search);
            $studentId = $student->id;
        } else {
            $student = $students->get($studentId);
        }

        $studentRankQuery = $students->find()
            ->where(['students.id IS' => $studentId])
            ->contain('Ranks');    
        $currentRank = $studentRankQuery->first()->rank;
        $nextRank = $ranks->get($currentRank->id + 1);

        $subranks = $this->getTableLocator()->get('Subranks');
        $subranksQuery = $subranks->find()
                        ->contain([
                            'Ranks',
                            'Worksheets' => ['Results' => function ($q) use ($studentId) {
                                return $q->select(['worksheet_id','student_id','result'])
                                            ->where(['student_id IS' => $studentId]);
                            }],
                        ])
                        ->where(['Subranks.rank_id IS' => $nextRank->id]);
        $subranksWithResults = $subranksQuery->all();

        $this->set(compact('subranksWithResults', 'student', 'currentRank', 'nextRank'));
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
        $students = $this->Results->Students->find('list', ['limit' => 200]);
        $worksheets = $this->Results->Worksheets->find('list', ['limit' => 200]);
        $this->set(compact('result', 'students', 'worksheets'));
    }

    /**
     * addBulk method
     * Inserts empty results (char "□") for the student $studentId at the rank of $rankId
     *
     * @param int|null $studentId Students.Id
     * @param int|null $rankId Ranks.Id
     * @return \Cake\Http\Response|null|void Redirects to index with appropriate info message.
     */
    public function addBulk($studentId = null, $rankId = 1)
    {
        $insertCount = 0;
        //fetch all subranks and associated worksheets for given Rank
        $worksheetsQuery = $this->getTableLocator()->get('Worksheets')->find()
                            ->contain(['Subranks', 'Subranks.Ranks'])
                            ->where(['Ranks.id IS' => $rankId]);

        $worksheets = $worksheetsQuery->all();

        // b- fetch all worksheets for each subrank
        foreach ($worksheets as $worksheet) {
            $result = $this->Results->newEmptyEntity();
            $result->student_id = $studentId;
            $result->worksheet_id = $worksheet->id;
            $result->result = '□';
            $success = $this->Results->save($result);
            $insertCount += 1;
        }

        $this->Flash->info(__('For student #{0}: {1} result(s) have been inserted. {2} result(s) have failed to be created.', $studentId, $insertCount, $worksheets->count() - $insertCount));

        return $this->redirect(['action' => 'index']);
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
     * updateStudentResults method
     *
     * @return \Cake\Http\Response|null|void Redirects to index.
     */
    public function updateStudentResults($studentId)
    {
        $data = $this->request->getData();
        $map = [ 0 => '□', 1 => '◎', 2 => '△'];

        $successCount = 0;

        foreach ($data as $worksheetKey => $resultValue) {
            $result = $this->Results->newEmptyEntity();
            $result->student_id = $studentId;
            $result->worksheet_id = $worksheetKey;
            $result->result = $map[$resultValue];
            $successCount += $this->Results->save($result) ? 1 : 0;
        }

        $this->Flash->info(__('{0} result(s) have been updated. {1} result(s) have failed to be updated.', $successCount, count($data) - $successCount ));

        return $this->redirect([
                        'controller' => 'Results',
                        'action' => 'view',
                        $studentId,
                    ]);
    }

    /**
     * updateToIndex method
     *
     * @return \Cake\Http\Response|null|void Redirects to index.
     */
    public function updateToIndex($studentId)
    {
        $data = $this->request->getData();
        $map = [ 0 => '□', 1 => '◎', 2 => '△'];

        $successCount = 0;

        foreach ($data as $worksheetKey => $resultValue) {
            $result = $this->Results->newEmptyEntity();
            $result->student_id = $studentId;
            $result->worksheet_id = $worksheetKey;
            $result->result = $map[$resultValue];
            $successCount += $this->Results->save($result) ? 1 : 0;
        }

        $this->Flash->info(__('{0} result(s) have been updated. {1} result(s) have failed to be updated.', $successCount, count($data) - $successCount ));

        return $this->redirect([
                        'controller' => 'Results',
                        'action' => 'index',
                        $studentId,
                    ]);
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

    public function createEmptyForStudent($studentId = null, $rankId = null)
    {

    }
}
