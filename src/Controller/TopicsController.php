<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Topics Controller
 *
 * @property \App\Model\Table\TopicsTable $Topics
 *
 * @method \App\Model\Entity\Topic[] paginate($object = null, array $settings = [])
 */
class TopicsController extends AppController
{
		
	/**
	* Allowing Regular to view only signup page when person is not loggin
	*/
	public function beforeFilter(Event $event){
		$this->Auth->allow(['index']);
	}
	
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $topics = $this->paginate($this->Topics);
        $this->set(compact('topics', 'auth'));
        $this->set('_serialize', ['topics']);
    }

    /**
     * View method
     *
     * @param string|null $id Topic id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $topic = $this->Topics->get($id, [
            'contain' => ['Users', 'Posts']
        ]);
		$users_data = $this->Topics->Users->find();
        //$this->set('topic', $topic);
		$this->set(compact('topic', 'users_data'));
        $this->set('_serialize', ['topic']);
		
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $topic = $this->Topics->newEntity();
        if ($this->request->is('post')) {
			//set user role (visible = 1, hidden = 2)
			$this->request->data['visibility'] = 2;
            $topic = $this->Topics->patchEntity($topic, $this->request->getData());
            if ($this->Topics->save($topic)) {
                $this->Flash->success(__('The topic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The topic could not be saved. Please, try again.'));
        }
		
        $users = $this->Topics->Users->find('list', ['keyField' => 'id', 'valueField' => 'full_name', 'limit' => 200]);
        $this->set(compact('topic', 'users'));
        $this->set('_serialize', ['topic']);
		
    }

    /**
     * Edit method
     *
     * @param string|null $id Topic id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $topic = $this->Topics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $topic = $this->Topics->patchEntity($topic, $this->request->getData());
            if ($this->Topics->save($topic)) {
                $this->Flash->success(__('The topic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The topic could not be saved. Please, try again.'));
        }
		$users = $this->Topics->Users->find('list', ['keyField' => 'id', 'valueField' => 'full_name', 'limit' => 200]);
        $this->set(compact('topic', 'users'));
        $this->set('_serialize', ['topic']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Topic id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $topic = $this->Topics->get($id);
        if ($this->Topics->delete($topic)) {
            $this->Flash->success(__('The topic has been deleted.'));
        } else {
            $this->Flash->error(__('The topic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
