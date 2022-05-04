<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ranks Controller
 *
 * @property \App\Model\Table\RanksTable $Ranks
 * @method \App\Model\Entity\Rank[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RanksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $ranks = $this->paginate($this->Ranks);

        $this->set(compact('ranks'));
    }

    /**
     * View method
     *
     * @param string|null $id Rank id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rank = $this->Ranks->get($id, [
            'contain' => ['Students', 'Subranks'],
        ]);

        $this->set(compact('rank'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rank = $this->Ranks->newEmptyEntity();
        if ($this->request->is('post')) {
            $rank = $this->Ranks->patchEntity($rank, $this->request->getData());
            if ($this->Ranks->save($rank)) {
                $this->Flash->success(__('The rank has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rank could not be saved. Please, try again.'));
        }
        $this->set(compact('rank'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rank id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rank = $this->Ranks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rank = $this->Ranks->patchEntity($rank, $this->request->getData());
            if ($this->Ranks->save($rank)) {
                $this->Flash->success(__('The rank has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rank could not be saved. Please, try again.'));
        }
        $this->set(compact('rank'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rank id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rank = $this->Ranks->get($id);
        if ($this->Ranks->delete($rank)) {
            $this->Flash->success(__('The rank has been deleted.'));
        } else {
            $this->Flash->error(__('The rank could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
