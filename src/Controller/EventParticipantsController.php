<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * EventParticipants Controller
 *
 * @property \App\Model\Table\EventParticipantsTable $EventParticipants
 * @method \App\Model\Entity\EventParticipant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventParticipantsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Participants', 'Events'],
        ];
        $eventParticipants = $this->paginate($this->EventParticipants);

        $this->set(compact('eventParticipants'));
    }

    /**
     * View method
     *
     * @param string|null $id Event Participant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventParticipant = $this->EventParticipants->get($id, [
            'contain' => ['Participants', 'Events'],
        ]);

        $this->set(compact('eventParticipant'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventParticipant = $this->EventParticipants->newEmptyEntity();
        if ($this->request->is('post')) {
            $eventParticipant = $this->EventParticipants->patchEntity($eventParticipant, $this->request->getData());
            if ($this->EventParticipants->save($eventParticipant)) {
                $this->Flash->success(__('The event participant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event participant could not be saved. Please, try again.'));
        }
        $participants = $this->EventParticipants->Participants->find('list', ['limit' => 200])->all();
        $events = $this->EventParticipants->Events->find('list', ['limit' => 200])->all();
        $this->set(compact('eventParticipant', 'participants', 'events'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Participant id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventParticipant = $this->EventParticipants->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventParticipant = $this->EventParticipants->patchEntity($eventParticipant, $this->request->getData());
            if ($this->EventParticipants->save($eventParticipant)) {
                $this->Flash->success(__('The event participant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event participant could not be saved. Please, try again.'));
        }
        $participants = $this->EventParticipants->Participants->find('list', ['limit' => 200])->all();
        $events = $this->EventParticipants->Events->find('list', ['limit' => 200])->all();
        $this->set(compact('eventParticipant', 'participants', 'events'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Participant id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventParticipant = $this->EventParticipants->get($id);
        if ($this->EventParticipants->delete($eventParticipant)) {
            $this->Flash->success(__('The event participant has been deleted.'));
        } else {
            $this->Flash->error(__('The event participant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
