<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 */
class PostsController extends AppController
{
    public $paginate = [
        'limit' => 10,
        'order' => [
            'Posts' => 'asc'
        ]
    ];

    public function initialize(){
        parent::initialize();

        // Include the FlashComponent
        $this->loadComponent('Flash');

        // Load Files model
        $this->loadModel('Posts');

        // Set the layout
       // $this->layout = 'frontend';
    }
    public function isAuthorized($user)
    {
        // All registered users can add articles
        if ($this->request->getParam('action') === 'addpost') {
            return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->getParam('action'), ['edit', 'delete','view'])) {
            $postId = (int)$this->request->getParam('pass.0');
            if ($this->Posts->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Categories']
        ];
        $posts = $this->paginate($this->Posts);

        $this->set(compact('posts'));
        $this->set('_serialize', ['posts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Users', 'Categories', 'Comments', 'PostTags']
        ]);

        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }
    public function viewcontent($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Users', 'Categories', 'Comments', 'PostTags']
        ]);
        $this->set('post', $post);
        $this->set('_serialize', ['post']);
    }
    public function upost($userid)
    {
        $query = $this->Posts->find()->contain(['Users'])->where(['user_id' => $userid])->order(['Posts.created'=>'DESC']);
        $uid = $this->Auth->user('id');
        $username = $this->Auth->user('username');
        $users= $this->paginate('Users');
        $this->set(compact('uid','username','users'));
        if($uid != $userid){
            $query->where(['is_private' => 0]);
        }
        $this->set('post', $this->paginate($query));
    }
    public function add()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $categories = $this->Posts->Categories->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users', 'categories'));
        $this->set('_serialize', ['post']);
    }

    public function addpost()
    {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {

            if($this->request->data['image']['name']){
                $fileName = $this->request->data['image']['name'];
                $uploadPath = "img/upload";
                if(is_dir($uploadPath)==NULL){
                    mkdir($uploadPath, 0777);
                }
                $uploadFile = $uploadPath.$fileName;
                $post = $this->Posts->patchEntity($post, $this->request->getData());
                $post->user_id = $this->Auth->user('id');

                if(move_uploaded_file($this->request->data['image']['tmp_name'],$uploadFile)){
                    $post->images = $fileName;
//                    var_dump($post->images);
                    if ($this->Posts->save($post)) {
                        $this->Flash->success(__('The post has been saved.'));
                        return $this->redirect(['controller' => 'Users', 'action' => 'view',$post->user_id ]);

                    }else{
                        $this->Flash->error(__('The post could not be saved. Please, try again.'));
                    }
                }else{
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            }else{
                $this->Flash->error(__('Please choose a file to upload.'));
            }
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $categories = $this->Posts->Categories->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users', 'categories'));
        $this->set('_serialize', ['post']);
    }
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if($this->request->data['image']['name']){
                $fileName = $this->request->data['image']['name'];
                $uploadPath = "img/upload";
                if(is_dir($uploadPath)==NULL){
                    mkdir($uploadPath, 0777);
                }
                $uploadFile = $uploadPath.$fileName;
            $post = $this->Posts->patchEntity($post, $this->request->getData());
                $post->user_id = $this->Auth->user('id');
                if(move_uploaded_file($this->request->data['image']['tmp_name'],$uploadFile)){
                    $post->images = $fileName;
                    if ($this->Posts->save($post)) {
                        $this->Flash->success(__('The post has been saved.'));
                        return $this->redirect(['controller' => 'Users', 'action' => 'view',$post->user_id]);

                    }else{
                        $this->Flash->error(__('The post could not be saved. Please, try again.'));
                    }
                }else{
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            }else{
                $this->Flash->error(__('Please choose a file to upload.'));
            }
           
            $this->Flash->error(__('Please choose a file to upload.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $categories = $this->Posts->Categories->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users', 'categories'));
        $this->set('_serialize', ['post']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'Users', 'action' => 'view',$post->user_id]);
    }
}
