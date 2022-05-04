<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResultsFixture
 */
class ResultsFixture extends TestFixture
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
                'student_id' => 1,
                'worksheet_id' => 1,
                'result' => 'Lore',
                'created' => '2022-05-04 01:40:36',
                'updated' => '2022-05-04 01:40:36',
            ],
        ];
        parent::init();
    }
}
