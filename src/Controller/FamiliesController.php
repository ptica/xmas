<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Families Controller
 *
 * @property \App\Model\Table\FamiliesTable $Families
 */
class FamiliesController extends AppController
{
    public function year($year = null) {
        if (!$year) $year = date('Y');
        $this->loadModel('Users');

        $query = $this->Users->find('all', ['contain' => ['Presents', 'Presents.Givers', ]]);
        $users = $this->paginate($query);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $families = $this->paginate($this->Families);

        $this->set(compact('families'));
        $this->set('_serialize', ['families']);
    }

    /**
     * View method
     *
     * @param string|null $id Family id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $family = $this->Families->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('family', $family);
        $this->set('_serialize', ['family']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $family = $this->Families->newEntity();
        if ($this->request->is('post')) {
            $family = $this->Families->patchEntity($family, $this->request->data);
            $family->user_id = $this->Auth->user('id');
            if ($this->Families->save($family)) {
                $this->Flash->success(__('The family has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The family could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('family'));
        $this->set('_serialize', ['family']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Family id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $family = $this->Families->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $family = $this->Families->patchEntity($family, $this->request->data);
            if ($this->Families->save($family)) {
                $this->Flash->success(__('The family has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The family could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('family'));
        $this->set('_serialize', ['family']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Family id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $family = $this->Families->get($id);
        if ($this->Families->delete($family)) {
            $this->Flash->success(__('The family has been deleted.'));
        } else {
            $this->Flash->error(__('The family could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
