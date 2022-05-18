<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RankHistoryFixture
 */
class RankHistoryFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'rank_history';
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
                'created' => '2022-05-08 09:42:04',
                'updated' => '2022-05-08 09:42:04',
            ],
        ];
        parent::init();
    }
}
