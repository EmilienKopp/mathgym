<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Worksheets Controller
 *
 * @property \App\Model\Table\WorksheetsTable $Worksheets
 * @method \App\Model\Entity\Worksheet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WorksheetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Subranks.Ranks'],
        ];
        $worksheets = $this->paginate($this->Worksheets);

        $this->set(compact('worksheets'));
    }

    /**
     * View method
     *
     * @param string|null $id Worksheet id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $worksheet = $this->Worksheets->get($id, [
            'contain' => ['Subranks.Ranks', 'Results'],
        ]);

        $this->set(compact('worksheet', 'subranks'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $worksheet = $this->Worksheets->newEmptyEntity();
        if ($this->request->is('post')) {
            $worksheet = $this->Worksheets->patchEntity($worksheet, $this->request->getData());
            if ($this->Worksheets->save($worksheet)) {
                $this->Flash->success(__('The worksheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The worksheet could not be saved. Please, try again.'));
        }
        $subranks = $this->Worksheets->Subranks->find('list', ['limit' => 200])->all();
        $this->set(compact('worksheet', 'subranks'));
    }

    /**
     * addBulk method
     *
     * Adds 10 (TODO: don't hard code but set this in config) worksheets to every Subrank in given Rank
     **/
    public function seed()
    {
        $rankId = $this->request->getData('rank_id');
        $success = true;
        $fails = 0;

        if ($this->request->is('post')) {
            //fetch all subranks for given rank
            $subranks = $this->Worksheets->Subranks->find()
                        ->select('id')
                        ->where(['rank_id IS' => $rankId])->all();
            $addedCount = 0;
            foreach ($subranks as $subrank) {
                for ($i = 1; $i <= 10; $i++) {
                    ++$addedCount;
                    $worksheet = $this->Worksheets->newEmptyEntity();
                    $worksheetBuiltID = $subrank->id * 10 + $i;
                    $worksheet->id = $worksheetBuiltID;
                    $worksheet->subrank_id = $subrank->id;
                    $success = $this->Worksheets->save($worksheet);
                    $fails = $success ? $fails : $fails + 1;
                }
            }
            if ($success) {
                $this->Flash->success(__('{0} worksheet(s) have been saved.', $addedCount - $fails));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('{0} worksheets could not be saved. Please, try again.', $fails));
            }
        }
        $subranks = $this->Worksheets->Subranks->find('list', ['limit' => 200])->all();
        $ranks = $this->Worksheets->Subranks->Ranks->find('list')->all();
        $this->set(compact('subranks', 'ranks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Worksheet id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $worksheet = $this->Worksheets->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $worksheet = $this->Worksheets->patchEntity($worksheet, $this->request->getData());
            if ($this->Worksheets->save($worksheet)) {
                $this->Flash->success(__('The worksheet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The worksheet could not be saved. Please, try again.'));
        }
        $subranks = $this->Worksheets->Subranks->find('list', ['limit' => 200])->all();
        $this->set(compact('worksheet', 'subranks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Worksheet id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $worksheet = $this->Worksheets->get($id);
        if ($this->Worksheets->delete($worksheet)) {
            $this->Flash->success(__('The worksheet has been deleted.'));
        } else {
            $this->Flash->error(__('The worksheet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
