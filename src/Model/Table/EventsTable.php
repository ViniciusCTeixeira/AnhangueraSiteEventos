<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EventsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('events');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always'
                ]
            ]
        ]);

        $this->belongsTo('Speakers', [
            'foreignKey' => 'speaker_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('EventParticipants', [
            'foreignKey' => 'event_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 4294967295)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->dateTime('date_time_start')
            ->requirePresence('date_time_start', 'create')
            ->notEmptyDateTime('date_time_start');

        $validator
            ->dateTime('date_time_stop')
            ->requirePresence('date_time_stop', 'create')
            ->notEmptyDateTime('date_time_stop');

        $validator
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('speaker_id', 'Speakers'), ['errorField' => 'speaker_id']);

        return $rules;
    }
}
