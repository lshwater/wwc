<?php
App::uses('Selectionlist', 'Model');

/**
 * Selectionlist Test Case
 *
 */
class SelectionlistTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.selectionlist',
		'app.selectionitem',
		'app.userinputfield'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Selectionlist = ClassRegistry::init('Selectionlist');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Selectionlist);

		parent::tearDown();
	}

}
