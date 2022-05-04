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
            'contain' => ['Subranks'],
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
            'contain' => ['Subranks', 'Results'],
        ]);

        $this->set(compact('worksheet'));
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
