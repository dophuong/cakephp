<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */

class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        // Add logout to the allowed actions list.
        $this->Auth->allow(['logout','register']);
    }

    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['edit', 'delete','view'])) {
            $userId = (int)$this->request->getParam('pass.0');
            if ($userId == $user['id']) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function login()
    {
        if($this->Auth->user('id')){
            
            $this->redirect(array('controller'=>'Pages','action'=>'display'));
        }

        if ($this->request->is('post')){
            $user = $this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(_('Invalid username or password, try again'));
        }
    }
    public function logout(){
        return $this->redirect($this->Auth->logout());
    }
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Posts']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }
    public function viewUser($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Posts']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'register']);
            }
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
            $groups = $this->Users->Groups->find('list');
            $this->set(compact('user', 'groups'));
            $this->set('_serialize', ['user']);
        }
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Users', 'action' => 'view',$user->user_id]);

    }
}
