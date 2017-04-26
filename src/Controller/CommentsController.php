<?php
namespace App\Controller;
use Cake\Error\Debugger;
use Cake\ORM\TableRegistry;

//use App\Controller\AppController;
//use Cake\Core\Exception\Exception;
/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        // Add logout to the allowed actions list.
        $this->Auth->allow(['getComment']);
    }
    public function isAuthorized($user)
    {
        // All registered users can add articles
        if ($this->request->getParam('action') === 'add') {
            return true;
        }
        // The owner of an article can edit and delete it
        if (in_array($this->request->getParam('action'), ['edit', 'delete','view'])) {
            $commentId = (int)$this->request->getParam('pass.0');
            if ($this->Comments->isOwnedBy($commentId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
    /**
     * Index method
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Posts']
        ];
        $comments = $this->paginate($this->Comments);

        $this->set(compact('comments'));
        $this->set('_serialize', ['comments']);
    }
    /**
     * View method
     *
     * @param string|null $id Comment id.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Posts']
        ]);

        $this->set('comment', $comment);
        $this->set('_serialize', ['comment']);
    }
    /**
     * Add method
     * @param int $postId
     * @return \Cake\Http\Response|null
     */
    public function add($postId)
    {
            if ($this->request->is('post')){
                if (!empty($this->request->getData())) {
                    $comment =$this->Comments->newEntity();
                    $comment = $this->Comments->patchEntity($comment, $this->request->getData());
                    $comment->author = $this->Auth->user('username');
                    $comment->post_id = $postId;
                    if ($this->Comments->save($comment)) {
                        $json = json_encode(array('success' => 'true'));
                    } else {
                        $json = json_encode(array('success' => 'fail'));
                    }
                }else {
                    $json = json_encode(array('success' => 'false'));
                }
            }else {
                $json = json_encode(array('success' => 'cannot post'));
            }
        $this->response->body($json);
        $this->response->type('json');
        return $this->response;
    }

    /**
     * getComment method
     * @param int $postId
     * @return \Cake\Http\Response|null
     */
    public function getComment($postId){
        $this->autoRender = false;
        $comment = $this->Comments->find()
            ->contain(['Posts'])
            ->where(['post_id' => $postId])
            ->order(['Comments.created'=>'ASC']);
//         convert object => json
//        $json = json_encode($myObject);=>{"a":"b"....}
//        convert json => object
//        $obj = json_decode($json);=>stdClass Object ([a]=>b,....)
        $json = json_encode($comment);
        //print_r(json_decode($json));
        $this->response->type('json');
        $this->response->body($json);
        return $this->response;
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $posts = $this->Comments->Posts->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'posts'));
        $this->set('_serialize', ['comment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
