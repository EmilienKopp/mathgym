<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Tools\VerboseReturn;

/**
 * Results Model
 *
 * @property \App\Model\Table\StudentsTable&\Cake\ORM\Association\BelongsTo $Students
 * @property \App\Model\Table\WorksheetsTable&\Cake\ORM\Association\BelongsTo $Worksheets
 *
 * @method \App\Model\Entity\Result newEmptyEntity()
 * @method \App\Model\Entity\Result newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Result[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Result get($primaryKey, $options = [])
 * @method \App\Model\Entity\Result findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Result patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Result[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Result|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Result saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Result[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Result[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Result[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Result[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResultsTable extends Table
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

        $this->setTable('results');
        $this->setDisplayField(['student_id', 'worksheet_id']);
        $this->setPrimaryKey(['student_id', 'worksheet_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Worksheets', [
            'foreignKey' => 'worksheet_id',
            'joinType' => 'INNER',
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
            ->scalar('result')
            ->maxLength('result', 6)
            ->allowEmptyString('result');

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
        $rules->add($rules->existsIn('student_id', 'Students'), ['errorField' => 'student_id']);
        $rules->add($rules->existsIn('worksheet_id', 'Worksheets'), ['errorField' => 'worksheet_id']);

        return $rules;
    }

    /**
     * Creates blank results associated to the given student and rank
     *
     * @param int $studentId The ID of the student for whom to create results
     * @param int $rankId The ID of the rank at which the results are created
     * @return bool | true on success, false if one or more insert(s) fail
     */
    public function createManyForStudentAndRank($studentId, $rankId)
    {
        $isSuccess = true;
        $insertCount = 0;
        //fetch all subranks and associated worksheets for given Rank
        $worksheetsQuery = $this->Worksheets->find()
                            ->contain(['Subranks', 'Subranks.Ranks'])
                            ->where(['Ranks.id IS' => $rankId]);

        $worksheets = $worksheetsQuery->all();

        // b- fetch all worksheets for each subrank
        foreach ($worksheets as $worksheet) {
            $result = $this->newEmptyEntity();
            $result->student_id = $studentId;
            $result->worksheet_id = $worksheet->id;
            $result->result = '□';
            $isSuccess = $isSuccess && $this->save($result);
            $insertCount += 1;
        }

        return new VerboseReturn($isSuccess, $worksheets->count(), $insertCount);
    }
}
