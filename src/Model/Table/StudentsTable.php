<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \App\Model\Table\RanksTable&\Cake\ORM\Association\BelongsTo $Ranks
 * @property \App\Model\Table\GradesTable&\Cake\ORM\Association\BelongsTo $Grades
 * @property \App\Model\Table\ResultsTable&\Cake\ORM\Association\HasMany $Results
 *
 * @method \App\Model\Entity\Student newEmptyEntity()
 * @method \App\Model\Entity\Student newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Student get($primaryKey, $options = [])
 * @method \App\Model\Entity\Student findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Student[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Student|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Student[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentsTable extends Table
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

        $this->setTable('students');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Ranks', [
            'foreignKey' => 'rank_id',
        ]);
        $this->belongsTo('Grades', [
            'foreignKey' => 'grade_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Results', [
            'foreignKey' => 'student_id',
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
            ->scalar('student_number')
            ->maxLength('student_number', 8)
            ->allowEmptyString('student_number');

        $validator
            ->scalar('name')
            ->maxLength('name', 32)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('rank_id')
            ->requirePresence('rank_id','create');

        $validator
            ->integer('worksheets_count')
            ->allowEmptyString('worksheets_count');

        $validator
            ->integer('perfects_count')
            ->allowEmptyString('perfects_count');

        $validator
            ->integer('accuracy_rate')
            ->allowEmptyString('accuracy_rate');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 32)
            ->notEmptyString('password');

        $validator
            ->integer('grade_id')
            ->requirePresence('grade_id', 'create')
            ->notEmptyString('grade_id');

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
        $rules->add($rules->existsIn('grade_id', 'Grades'), ['errorField' => 'grade_id']);

        return $rules;
    }

    /**
     * Custom Finder method to find student by name or id
     *
     * @param string $search The search string (student id or name)
     * @return \App\Model\Entity\Student The student found by the search
     */
    public function findByNameOrId($search)
    {
        $student = $this->newEmptyEntity();
        $studentQuery = $this->find('all')
                ->where([
                    'OR' => ['students.name' => $search, 'student_number' => $search ],
                ])
                ->contain(['Ranks']);

        $student = $studentQuery->first();

        return $student;
    }

    public function updateStats($studentId) {
        $student = $this->get($studentId);

        //Get and assign the non-empty results (　◎ / △ )
        $query = $this->find();
        $query->select(['total_worksheets' => $query->func()->count('Results.result')])
            ->where(['student_id IS ' => $studentId])
            ->where(['Results.result <> ' => '□'])
            ->leftJoinWith('Results')
            ->group(['Students.id'])
            ->enableAutoFields(true);
        $student->worksheets_count = $query->first()->total_worksheets;


        //Get and assign the success results ( ◎ )
        $query = $this->find();
        $query->select(['total_success' => $query->func()->count('Results.result')])
            ->where(['student_id IS ' => $studentId])
            ->where(['Results.result IS ' => '◎'])
            ->leftJoinWith('Results')
            ->group(['Students.id'])
            ->enableAutoFields(true);
        $student->perfects_count = $query->first()->total_success;

        //Compute the accuracy rate
        $student->accuracy_rate = round(100 * $student->perfects_count / $student->worksheets_count,2);

        return $this->save($student);
    }
}
