<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Subrank;
use Cake\Error\Debugger;

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

        if ($this->request->is(['get'])) {
            $ranks = $this->Ranks->find()->all();
        }
        if ($this->request->is('post')) {
            $rankId = $this->getRankIdFromRequest();
            $rank = $this->Ranks->patchEntity($rank, $this->request->getData());
            $rank->id = $rankId;
            debug($rank->id);
            if (true){//$this->Ranks->save($rank)) {

                // Add subranks and worksheets
                // MUST BE PROCESSED AFTER ADDING RANK or the associated rank_id will not be present in the Ranks table
                $subranks = $this->getTableLocator()->get('Subranks');
                $worksheets = $this->getTableLocator()->get('Worksheets');
                if ($subranks->populateRankSubranks($rank->id,$rank->base,$rank->max)) {
                    $newSubranks = $subranks->find()
                                    ->where(['rank_id IS' => $rank->id]);
                    foreach ($newSubranks as $newSubrank) {
                        if (! $worksheets->populateSubrankWorksheets($newSubrank->id)) {
                            $this->Flash->error(__('One or more worksheets could not be created.'));
                        }
                    }
                    $this->Flash->success(__('The rank {0} and all its subranks have been successfully created', $rank->name));
                } else {
                    $this->Flash->error(__('One of the associated subranks or worksheets could not be saved. Check those sections for more information.'));
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rank could not be saved. Please, try again.'));
        }

        $this->set(compact('rank', 'ranks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rank id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * TODO: cascade changes of populateSubranks in case a ranks BASE or MAX are changed
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


    /**
     * getRankIdFromRequest method / Used mainly in ADD
     * Used to calculate the primary key (ID) of the rank based on the 'base' number.
     * Since ranks are groups of 5 subranks and 50 worksheets, and the 'base' is
     * the number of the first worksheet in each rank,
     * the ID is ( (base-1) / 50 ) + 1
     * i.e. The rank of id 2 starts with worksheet #51 (base propery = 51)
     * i.e. The rank of base #201 should be of id 5
     *
     * @return integer (the id of a rank that has a $base base number) or 0 if the request isn't post or update
     */
    public function getRankIdFromRequest ()
    {
        $base = (int)$this->request->getData('base');

        return $this->request->is(['post', 'patch', 'put']) ? $this->Ranks->calculatePrimaryKeyFromBase($base) : 0;
    }
}
