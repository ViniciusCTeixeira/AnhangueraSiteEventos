<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Speeches Controller
 *
 * @property \App\Model\Table\SpeechesTable $Speeches
 * @method \App\Model\Entity\Speech[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SpeechesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Speakers'],
        ];
        $speeches = $this->paginate($this->Speeches);

        $this->set(compact('speeches'));
    }

    /**
     * View method
     *
     * @param string|null $id Speech id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $speech = $this->Speeches->get($id, [
            'contain' => ['Speakers'],
        ]);

        $this->set(compact('speech'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $speech = $this->Speeches->newEmptyEntity();
        if ($this->request->is('post')) {
            $speech = $this->Speeches->patchEntity($speech, $this->request->getData());
            if ($this->Speeches->save($speech)) {
                $this->Flash->success(__('The speech has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The speech could not be saved. Please, try again.'));
        }
        $speakers = $this->Speeches->Speakers->find('list', ['limit' => 200])->all();
        $this->set(compact('speech', 'speakers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Speech id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $speech = $this->Speeches->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $speech = $this->Speeches->patchEntity($speech, $this->request->getData());
            if ($this->Speeches->save($speech)) {
                $this->Flash->success(__('The speech has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The speech could not be saved. Please, try again.'));
        }
        $speakers = $this->Speeches->Speakers->find('list', ['limit' => 200])->all();
        $this->set(compact('speech', 'speakers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Speech id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $speech = $this->Speeches->get($id);
        if ($this->Speeches->delete($speech)) {
            $this->Flash->success(__('The speech has been deleted.'));
        } else {
            $this->Flash->error(__('The speech could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
