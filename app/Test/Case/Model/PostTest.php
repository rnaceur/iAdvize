<?php
App::uses('Post', 'Model');

/**
 * Post Test Case
 *
 */
class PostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Post = ClassRegistry::init('Post');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Post);

		parent::tearDown();
	}

/**
 * testInsert method
 *
 * @return void
 */
	public function testInsert() {

		$recordsToTest = array(
			array('author' => 'Auteur', 'content' => 'Aujourd\'ui ... bla bla','date' => '2014-11-10 00:00:00','expected' => true), //Test OK
			array('author' => '', 'content' => 'Aujourd\'ui ... bla bla','date' => '2014-11-10 00:00:00','expected' => false), //Test KO pas d'auteur
			array('author' => 'Auteur', 'content' => '','date' => '2014-11-10 00:00:00','expected' => false), //Test KO pas de phrase
			array('author' => 'Auteur', 'content' => 'Aujourd\'ui ... bla bla','date' => '11-10-2014 00:00:00','expected' => false), //Test KO mauvais format date
		); 
		
		for($i=0; $i < count($recordsToTest);$i++) {
			$record = $recordsToTest[$i];
			$this->Post->create();
			
			$data['author'] = $record['author'];
			$data['content'] = $record['content'];
			$data['date'] = $record['date'];
			
			$result = $this->Post->save($data);	
		
			if($result != false) {
				$result = true;
			}
		
			$this->assertEqual($result,$record['expected']);
		}
	}

/**
 * testSuppr method
 *
 * @return void
 */
	public function testSuppr() {
		
	}

}
