<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventParticipantsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventParticipantsTable Test Case
 */
class EventParticipantsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EventParticipantsTable
     */
    protected $EventParticipants;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.EventParticipants',
        'app.Participants',
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
        $config = $this->getTableLocator()->exists('EventParticipants') ? [] : ['className' => EventParticipantsTable::class];
        $this->EventParticipants = $this->getTableLocator()->get('EventParticipants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->EventParticipants);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EventParticipantsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\EventParticipantsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
