<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpeechesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpeechesTable Test Case
 */
class SpeechesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SpeechesTable
     */
    protected $Speeches;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Speeches',
        'app.Speakers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Speeches') ? [] : ['className' => SpeechesTable::class];
        $this->Speeches = $this->getTableLocator()->get('Speeches', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Speeches);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SpeechesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SpeechesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
