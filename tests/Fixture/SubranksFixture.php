<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubranksFixture
 */
class SubranksFixture extends TestFixture
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
                'rank_id' => 1,
                'numwithin' => 1,
                'created' => '2022-05-04 00:49:02',
                'updated' => '2022-05-04 00:49:02',
            ],
        ];
        parent::init();
    }
}
