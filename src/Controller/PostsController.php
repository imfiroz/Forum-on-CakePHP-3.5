<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\Post[] paginate($object = null, array $settings = [])
 */
class PostsController extends AppController
{
	/**
	* Allowing Regular to view only index page when person is not loggin
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
            'contain' => ['Topics', 'Users']
        ];
        $posts = $this->paginate($this->Posts);

        $this->set(compact('posts'));
        $this->set('_serialize', ['posts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Topics', 'Users']
        ]);
		
        $this->set('post', $post);
        $this->set('_serialize', ['post']);
		
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($topic = null)
    {
		
        $post = $this->Posts->newEntity();
		
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['controller' => 'Topics', 'action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
		if(!empty($topic)):
        $topics = $this->Posts->Topics->find('list', ['conditions' => ['id' => $topic]]);
		else:
		$topics = $this->Posts->Topics->find('list', ['conditions' => ['visibility' => 1 ], 'limit' => 200]);
		endif;
        $users = $this->Posts->Users->find('list', ['keyField' => 'id', 'valueField' => 'full_name', 'limit' => 200]);
        $this->set(compact('post', 'topics', 'users'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $topic_id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['controller' => 'Topics', 'action' => 'view', $topic_id]);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $topics = $this->Posts->Topics->find('list', ['limit' => 200]);
        $users = $this->Posts->Users->find('list', ['keyField' => 'id', 'valueField' => 'full_name', 'limit' => 200]);
        $this->set(compact('post', 'topics', 'users'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $topic_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'Topics', 'action' => 'view', $topic_id]);
    }
}
