<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Subranks Controller
 *
 * @property \App\Model\Table\SubranksTable $Subranks
 * @method \App\Model\Entity\Subrank[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubranksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Ranks'],
        ];
        $subranks = $this->paginate($this->Subranks);

        $this->set(compact('subranks'));
    }

    /**
     * View method
     *
     * @param string|null $id Subrank id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subrank = $this->Subranks->get($id, [
            'contain' => ['Ranks', 'Worksheets'],
        ]);

        $this->set(compact('subrank'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subrank = $this->Subranks->newEmptyEntity();
        if ($this->request->is('post')) {
            $subrank = $this->Subranks->patchEntity($subrank, $this->request->getData());
            if ($this->Subranks->save($subrank)) {
                $this->Flash->success(__('The subrank has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subrank could not be saved. Please, try again.'));
        }
        $ranks = $this->Subranks->Ranks->find('list', ['limit' => 200])->all();
        $this->set(compact('subrank', 'ranks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subrank id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subrank = $this->Subranks->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subrank = $this->Subranks->patchEntity($subrank, $this->request->getData());
            if ($this->Subranks->save($subrank)) {
                $this->Flash->success(__('The subrank has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subrank could not be saved. Please, try again.'));
        }
        $ranks = $this->Subranks->Ranks->find('list', ['limit' => 200])->all();
        $this->set(compact('subrank', 'ranks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subrank id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subrank = $this->Subranks->get($id);
        if ($this->Subranks->delete($subrank)) {
            $this->Flash->success(__('The subrank has been deleted.'));
        } else {
            $this->Flash->error(__('The subrank could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}
