<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.userloginlog',
		'app.group',
		'app.groups_user',
		'app.unit',
		'app.agency',
		'app.users_unit',
		'app.userinputfield',
		'app.inputtype',
		'app.selectionlist',
		'app.selectionitem',
		'app.users_userinputfield'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

}
