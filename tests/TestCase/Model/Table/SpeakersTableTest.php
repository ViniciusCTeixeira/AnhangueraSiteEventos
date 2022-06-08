<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpeakersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpeakersTable Test Case
 */
class SpeakersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SpeakersTable
     */
    protected $Speakers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Speakers',
        'app.Events',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Speakers') ? [] : ['className' => SpeakersTable::class];
        $this->Speakers = $this->getTableLocator()->get('Speakers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Speakers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SpeakersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
