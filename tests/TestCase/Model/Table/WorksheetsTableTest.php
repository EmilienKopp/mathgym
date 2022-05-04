<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorksheetsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorksheetsTable Test Case
 */
class WorksheetsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\WorksheetsTable
     */
    protected $Worksheets;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Worksheets',
        'app.Subranks',
        'app.Results',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Worksheets') ? [] : ['className' => WorksheetsTable::class];
        $this->Worksheets = $this->getTableLocator()->get('Worksheets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Worksheets);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\WorksheetsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\WorksheetsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
