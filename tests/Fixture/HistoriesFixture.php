<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HistoriesFixture
 */
class HistoriesFixture extends TestFixture
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
                'rank_id' => 1,
                'created' => '2022-05-08 09:49:02',
                'updated' => '2022-05-08 09:49:02',
            ],
        ];
        parent::init();
    }
}
