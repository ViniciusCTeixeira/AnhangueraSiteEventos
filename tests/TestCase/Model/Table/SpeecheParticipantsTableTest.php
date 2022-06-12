<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpeecheParticipantsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpeecheParticipantsTable Test Case
 */
class SpeecheParticipantsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SpeecheParticipantsTable
     */
    protected $SpeecheParticipants;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.SpeecheParticipants',
        'app.Speeches',
        'app.Participants',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SpeecheParticipants') ? [] : ['className' => SpeecheParticipantsTable::class];
        $this->SpeecheParticipants = $this->getTableLocator()->get('SpeecheParticipants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SpeecheParticipants);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SpeecheParticipantsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SpeecheParticipantsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
