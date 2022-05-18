<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Histories Controller
 *
 * @property \App\Model\Table\HistoriesTable $Histories
 * @method \App\Model\Entity\History[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HistoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Ranks'],
        ];
        $histories = $this->paginate($this->Histories);

        $this->set(compact('histories'));
    }

    /**
     * View method
     *
     * @param string|null $id History id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($studentId = null)
    {

        $history = $this->Histories->recordRankUp($studentId);
        $this->set(compact('history'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $history = $this->Histories->newEmptyEntity();
        if ($this->request->is('post')) {
            $history = $this->Histories->patchEntity($history, $this->request->getData());
            if ($this->Histories->save($history)) {
                $this->Flash->success(__('The history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The history could not be saved. Please, try again.'));
        }
        $students = $this->Histories->Students->find('list', ['limit' => 200])->all();
        $ranks = $this->Histories->Ranks->find('list', ['limit' => 200])->all();
        $this->set(compact('history', 'students', 'ranks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id History id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $history = $this->Histories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $history = $this->Histories->patchEntity($history, $this->request->getData());
            if ($this->Histories->save($history)) {
                $this->Flash->success(__('The history has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The history could not be saved. Please, try again.'));
        }
        $students = $this->Histories->Students->find('list', ['limit' => 200])->all();
        $ranks = $this->Histories->Ranks->find('list', ['limit' => 200])->all();
        $this->set(compact('history', 'students', 'ranks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id History id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $history = $this->Histories->get($id);
        if ($this->Histories->delete($history)) {
            $this->Flash->success(__('The history has been deleted.'));
        } else {
            $this->Flash->error(__('The history could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
