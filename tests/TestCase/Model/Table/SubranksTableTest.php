<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubranksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubranksTable Test Case
 */
class SubranksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SubranksTable
     */
    protected $Subranks;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Subranks',
        'app.Ranks',
        'app.Worksheets',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Subranks') ? [] : ['className' => SubranksTable::class];
        $this->Subranks = $this->getTableLocator()->get('Subranks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Subranks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SubranksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SubranksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
