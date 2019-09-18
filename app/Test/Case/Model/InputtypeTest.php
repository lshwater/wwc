<?php
App::uses('Inputtype', 'Model');

/**
 * Inputtype Test Case
 *
 */
class InputtypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.inputtype',
		'app.userinputfield',
		'app.selectionlist',
		'app.selectionitem',
		'app.user',
		'app.users_userinputfield'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Inputtype = ClassRegistry::init('Inputtype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Inputtype);

		parent::tearDown();
	}

}
