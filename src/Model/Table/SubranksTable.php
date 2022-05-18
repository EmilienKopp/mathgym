<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Entity\Subrank;

/**
 * Subranks Model
 *
 * @property \App\Model\Table\RanksTable&\Cake\ORM\Association\BelongsTo $Ranks
 * @property \App\Model\Table\WorksheetsTable&\Cake\ORM\Association\HasMany $Worksheets
 *
 * @method \App\Model\Entity\Subrank newEmptyEntity()
 * @method \App\Model\Entity\Subrank newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Subrank[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subrank get($primaryKey, $options = [])
 * @method \App\Model\Entity\Subrank findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Subrank patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Subrank[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subrank|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subrank saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subrank[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subrank[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subrank[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subrank[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubranksTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('subranks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Ranks', [
            'foreignKey' => 'rank_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Worksheets', [
            'foreignKey' => 'subrank_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('rank_id')
            ->requirePresence('rank_id', 'create')
            ->notEmptyString('rank_id');

        $validator
            ->integer('numwithin')
            ->requirePresence('numwithin', 'create')
            ->notEmptyString('numwithin');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('rank_id', 'Ranks'), ['errorField' => 'rank_id']);

        return $rules;
    }

    /**
     * Populate method : creates [five] (TODO: make configurable) subranks in the given rank.
     * Called in Ranks/add method
     *
     * @param string|null $id Rank id.
     * @return bool False if even one insert fails
     */
    function populateRankSubranks($rankId, $base, $max)
    {
        $isSuccess = true;
        if ($rankId==0){
          return true;
        }
        $numberOfSubranks = (int)($max+1 - $base)/10;
        $previousSubrank = $this->select(['previous_rank' => $query->func()->max('subranks.id')]);
        debug($numberOfSubranks); die();
        for ($i = 0; $i < $numberOfSubranks; $i++) {
            $subrankId = (int)(10 * ($rankId - 1) + $i);
            $subrank = new Subrank([
                    'id' => $subrankId,
                    'rank_id' => $rankId,
                    'numwithin' => $i + 1,
            ]);
            $isSuccess = $isSuccess && $this->save($subrank);
        }

        return $isSuccess;
    }
}
