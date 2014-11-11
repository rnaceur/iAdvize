<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$authorParam = $this->request->query('author');
		$fromParam  = $this->request->query('from');
		$toParam = $this->request->query('to');
		
		if($authorParam != null)
			$posts = $this->Post->findAllByAuthor($authorParam);
		else if($fromParam != null and $toParam != null) {
			$start_date = $fromParam;
			$end_date = $toParam;
			$posts = $this->Post->find('all', array('conditions' => array('Post.date BETWEEN \''.$start_date.'\' AND \''.$end_date.'\'')));
		}
		else {
			$posts = $this->Post->find('all');
		}
		
		$this->set(array('posts' => $posts,'_serialize' => array('posts')));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
		$this->set(array('post' => $post,'_serialize' => array('post')));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->loadModel("Post");
		$this->Post->insert();
        $this->Session->setFlash(__('Les posts ont été ajoutés'));
		$this->autoRender = false;
		$this->redirect(array('action' => 'index'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Post->delete()) {
			$this->Session->setFlash(__('The post has been deleted.'));
		} else {
			$this->Session->setFlash(__('The post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function supprimer() {
		$this->loadModel("Post");
		$this->Post->suppr();
		$this->Session->setFlash(__('Les posts ont été supprimés'));
		$this->autoRender = false;
		$this->redirect(array('action' => 'index'));
	}
}
