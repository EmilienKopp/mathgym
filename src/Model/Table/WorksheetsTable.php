<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Worksheets Model
 *
 * @property \App\Model\Table\SubranksTable&\Cake\ORM\Association\BelongsTo $Subranks
 * @property \App\Model\Table\ResultsTable&\Cake\ORM\Association\HasMany $Results
 *
 * @method \App\Model\Entity\Worksheet newEmptyEntity()
 * @method \App\Model\Entity\Worksheet newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Worksheet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Worksheet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Worksheet findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Worksheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Worksheet[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Worksheet|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Worksheet saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Worksheet[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Worksheet[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Worksheet[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Worksheet[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WorksheetsTable extends Table
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

        $this->setTable('worksheets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Subranks', [
            'foreignKey' => 'subrank_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Results', [
            'foreignKey' => 'worksheet_id',
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
            ->integer('subrank_id')
            ->requirePresence('subrank_id', 'create')
            ->notEmptyString('subrank_id');

        $validator
            ->scalar('link')
            ->maxLength('link', 255)
            ->allowEmptyString('link');

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
        $rules->add($rules->existsIn('subrank_id', 'Subranks'), ['errorField' => 'subrank_id']);

        return $rules;
    }
}
