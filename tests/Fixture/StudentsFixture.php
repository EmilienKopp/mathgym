<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentsFixture
 */
class StudentsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'student_number' => 'Lorem ',
                'name' => 'Lorem ipsum dolor sit amet',
                'rank_id' => 1,
                'worksheets_count' => 1,
                'perfects_count' => 1,
                'accuracy_rate' => 1,
                'created' => '2022-05-04',
                'modified' => '2022-05-04',
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'grade_id' => 1,
            ],
        ];
        parent::init();
    }
}
