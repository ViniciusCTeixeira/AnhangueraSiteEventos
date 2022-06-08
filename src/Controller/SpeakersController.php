<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Speakers Controller
 *
 * @property \App\Model\Table\SpeakersTable $Speakers
 * @method \App\Model\Entity\Speaker[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SpeakersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $speakers = $this->paginate($this->Speakers);

        $this->set(compact('speakers'));
    }

    /**
     * View method
     *
     * @param string|null $id Speaker id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $speaker = $this->Speakers->get($id, [
            'contain' => ['Events'],
        ]);

        $this->set(compact('speaker'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $speaker = $this->Speakers->newEmptyEntity();
        if ($this->request->is('post')) {
            $speaker = $this->Speakers->patchEntity($speaker, $this->request->getData());
            if ($this->Speakers->save($speaker)) {
                $this->Flash->success(__('The speaker has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The speaker could not be saved. Please, try again.'));
        }
        $this->set(compact('speaker'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Speaker id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $speaker = $this->Speakers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $speaker = $this->Speakers->patchEntity($speaker, $this->request->getData());
            if ($this->Speakers->save($speaker)) {
                $this->Flash->success(__('The speaker has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The speaker could not be saved. Please, try again.'));
        }
        $this->set(compact('speaker'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Speaker id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $speaker = $this->Speakers->get($id);
        if ($this->Speakers->delete($speaker)) {
            $this->Flash->success(__('The speaker has been deleted.'));
        } else {
            $this->Flash->error(__('The speaker could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
