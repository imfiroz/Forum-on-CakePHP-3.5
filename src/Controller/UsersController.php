<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	
	/**
	* Allowing Regular to view only signup page when person is not loggin
	*/
	public function beforeFilter(Event $event){
		$this->Auth->allow(['signup']);
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Posts', 'Topics']
        ]);
		$topics_data = $this->Users->Topics->find();
        $this->set(compact('user', 'topics_data'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
		
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
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
     * @return \Cake\Http\Response|null Redirects to index.
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

        return $this->redirect(['action' => 'index']);
    }
	/**
	*  login function for users
	**/
	public function login()
	{
			//Check if user is already login
			if($this->Auth->user('id')){
				$this->Flash->success(__('You are already loggedIn'));
				return $this->redirect($this->Auth->redirectUrl(['controller' => 'Users', 'action' => 'index']));
			}else{
			//if user are not logged in attempt to login
				if($this->request->is('post')){ //cheacking for post method
					$user = $this->Auth->identify();
				
					if ($user) {
						$this->Auth->setUser($user);
						//Success Massege
						$this->Flash->success(__('Login Successful'));
						return $this->redirect($this->Auth->redirectUrl(['controller' => 'Topics', 'action' => 'index']));
					} else {
						$this->Flash->error(__('Username or password is incorrect'));
					}
				}
				
			}
	}
	/**
	*  Logged out function for users
	**/
	public function logout(){
		$this->Flash->success('You are logged out');
		return $this->redirect($this->Auth->logout()); //redirect to logout
	}
	/**
	*  Signup function for users
	**/
	public function signup()
	{
		$user = $this->Users->newEntity();
		
        if ($this->request->is('post')) {
			
			//set user role (regular= 1, admin = 2)
			$this->request->data['role'] = 1;
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
	}
}
