<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventParticipantsFixture
 */
class EventParticipantsFixture extends TestFixture
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
                'created' => '2022-04-11 20:23:18',
                'modified' => '2022-04-11 20:23:18',
                'participant_id' => 1,
                'event_id' => 1,
                'cert' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
