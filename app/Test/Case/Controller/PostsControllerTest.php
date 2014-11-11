<?php
App::uses('PostsController', 'Controller');

/**
 * PostsController Test Case
 *
 */
class PostsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$result = $this->testAction('/posts');
        debug($result);
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$result = $this->testAction('/posts/1');
        debug($result);
	}

/**
 * testRecuperer method
 *
 * @return void
 */
	public function testRecuper() {
		$result = $this->testAction('/posts/recuperer');
        debug($result);
	}

/**
 * testSupprimer method
 *
 * @return void
 */
	public function testDelete() {
		$result = $this->testAction('/posts/supprimer');
        debug($result);
	}

}
