<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Histories Model
 *
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\RanksTable&\Cake\ORM\Association\BelongsTo $Ranks
 *
 * @method \App\Model\Entity\History newEmptyEntity()
 * @method \App\Model\Entity\History newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\History[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\History get($primaryKey, $options = [])
 * @method \App\Model\Entity\History findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\History patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\History[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\History|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\History saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\History[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\History[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\History[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\History[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HistoriesTable extends Table
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

        $this->setTable('histories');
        $this->setDisplayField(['student_id', 'rank_id']);
        $this->setPrimaryKey(['student_id', 'rank_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Ranks', [
            'foreignKey' => 'rank_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn('student_id', 'Students'), ['errorField' => 'student_id']);

        return $rules;
    }

    public function recordRankUp($studentId)
    {
        $student = $this->Students->get($studentId, ['contain' => 'Ranks']);
        $rankQuery = $this->find()->select('rank_id')
                          ->where(['student_id IS' => $studentId]);
        $maxRankRecord = $rankQuery->max(function ($max) {
            return $max->rank_id;
        });

        $newRankId = $maxRankRecord == null ? 1 : $maxRankRecord->rank_id + 1;
        $history = $this->newEmptyEntity();
        $history->student_id = $studentId;
        $history->rank_id = $newRankId;
        $this->save($history);
    }
}
