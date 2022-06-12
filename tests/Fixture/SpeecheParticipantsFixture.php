<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SpeecheParticipantsFixture
 */
class SpeecheParticipantsFixture extends TestFixture
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
                'created' => '2022-06-12 15:20:34',
                'modified' => '2022-06-12 15:20:34',
                'cert' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'speeche_id' => 1,
                'participant_id' => 1,
            ],
        ];
        parent::init();
    }
}
