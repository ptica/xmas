<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Presents Controller
 *
 * @property \App\Model\Table\PresentsTable $Presents
 */
class PresentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $presents = $this->paginate($this->Presents);

        $this->set(compact('presents'));
        $this->set('_serialize', ['presents']);
    }

    /**
     * View method
     *
     * @param string|null $id Present id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $present = $this->Presents->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('present', $present);
        $this->set('_serialize', ['present']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $present = $this->Presents->newEntity();

        if ($this->request->is('ajax')) {
            $present = $this->Presents->patchEntity($present, $this->request->data);
            $present->giver_id = $this->Auth->user('id');
            if ($this->Presents->save($present)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
            $this->set([
                'message' => $message,
                'present' => $present,
                '_serialize' => ['message', 'present']
            ]);
            return;
        }

        if ($this->request->is('post')) {
            $present = $this->Presents->patchEntity($present, $this->request->data);
            $present->giver_id = $this->Auth->user('id');
            if ($this->Presents->save($present)) {
                $this->Flash->success(__('Je to tam!'));
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('The present could not be saved. Please, try again.'));
            }
        }
        $users = $this->Presents->Users->find('list', ['limit' => 200]);
        $this->set(compact('present', 'users'));
        $this->set('_serialize', ['present']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Present id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $present = $this->Presents->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $present = $this->Presents->patchEntity($present, $this->request->data);
            if ($this->Presents->save($present)) {
                $this->Flash->success(__('Hotovo!'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The present could not be saved. Please, try again.'));
            }
        }
        $users = $this->Presents->Users->find('list', ['limit' => 200]);
        $this->set(compact('present', 'users'));
        $this->set('_serialize', ['present']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Present id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $present = $this->Presents->get($id);
        if ($this->Presents->delete($present)) {
            $messages = ['A je pryč!', 'Fuč!', 'Niente.'];
            $this->Flash->success($messages[array_rand($messages)]);
        } else {
            $this->Flash->error(__('The present could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
