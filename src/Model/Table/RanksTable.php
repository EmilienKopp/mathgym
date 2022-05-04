<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ranks Model
 *
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\HasMany $Students
 * @property \App\Model\Table\SubranksTable&\Cake\ORM\Association\HasMany $Subranks
 *
 * @method \App\Model\Entity\Rank newEmptyEntity()
 * @method \App\Model\Entity\Rank newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Rank[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rank get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rank findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Rank patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rank[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rank|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rank saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rank[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rank[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rank[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rank[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RanksTable extends Table
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

        $this->setTable('ranks');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Students', [
            'foreignKey' => 'rank_id',
        ]);
        $this->hasMany('Subranks', [
            'foreignKey' => 'rank_id',
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
            ->scalar('name')
            ->maxLength('name', 6)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('base')
            ->requirePresence('base', 'create')
            ->notEmptyString('base');

        return $validator;
    }
}
