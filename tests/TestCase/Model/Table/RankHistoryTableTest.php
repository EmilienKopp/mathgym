<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RankHistoryTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RankHistoryTable Test Case
 */
class RankHistoryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RankHistoryTable
     */
    protected $RankHistory;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.RankHistory',
        'app.Students',
        'app.Ranks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RankHistory') ? [] : ['className' => RankHistoryTable::class];
        $this->RankHistory = $this->getTableLocator()->get('RankHistory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RankHistory);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RankHistoryTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
