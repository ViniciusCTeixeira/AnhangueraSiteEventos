<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SpeecheParticipants Controller
 *
 * @property \App\Model\Table\SpeecheParticipantsTable $SpeecheParticipants
 * @method \App\Model\Entity\SpeecheParticipant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SpeecheParticipantsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Speeches', 'Participants'],
        ];
        $speecheParticipants = $this->paginate($this->SpeecheParticipants);

        $this->set(compact('speecheParticipants'));
    }

    /**
     * View method
     *
     * @param string|null $id Speeche Participant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $speecheParticipant = $this->SpeecheParticipants->get($id, [
            'contain' => ['Speeches', 'Participants'],
        ]);

        $this->set(compact('speecheParticipant'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $speecheParticipant = $this->SpeecheParticipants->newEmptyEntity();
        if ($this->request->is('post')) {
            $speecheParticipant = $this->SpeecheParticipants->patchEntity($speecheParticipant, $this->request->getData());
            if ($this->SpeecheParticipants->save($speecheParticipant)) {
                $this->Flash->success(__('The speeche participant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The speeche participant could not be saved. Please, try again.'));
        }
        $speeches = $this->SpeecheParticipants->Speeches->find('list', ['limit' => 200])->all();
        $participants = $this->SpeecheParticipants->Participants->find('list', ['limit' => 200])->all();
        $this->set(compact('speecheParticipant', 'speeches', 'participants'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Speeche Participant id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $speecheParticipant = $this->SpeecheParticipants->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $speecheParticipant = $this->SpeecheParticipants->patchEntity($speecheParticipant, $this->request->getData());
            if ($this->SpeecheParticipants->save($speecheParticipant)) {
                $this->Flash->success(__('The speeche participant has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The speeche participant could not be saved. Please, try again.'));
        }
        $speeches = $this->SpeecheParticipants->Speeches->find('list', ['limit' => 200])->all();
        $participants = $this->SpeecheParticipants->Participants->find('list', ['limit' => 200])->all();
        $this->set(compact('speecheParticipant', 'speeches', 'participants'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Speeche Participant id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $speecheParticipant = $this->SpeecheParticipants->get($id);
        if ($this->SpeecheParticipants->delete($speecheParticipant)) {
            $this->Flash->success(__('The speeche participant has been deleted.'));
        } else {
            $this->Flash->error(__('The speeche participant could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
