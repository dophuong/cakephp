<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $this->Auth->allow(['add','getcomment']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
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
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
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
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($post_id)
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            $comment->post_id = $post_id;
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'getComment'],$post_id);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $posts = $this->Comments->Posts->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'posts'));
        $this->set('_serialize', ['comment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function getComment($post_id){
        $this->autoRender = false;
        $comment = $this->Comments->find()->contain(['Posts'])->where(['post_id' => $post_id])->order(['Comments.created'=>'ASC']);
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
