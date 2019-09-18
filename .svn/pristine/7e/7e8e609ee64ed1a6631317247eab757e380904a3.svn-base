<?php
App::uses('UsersPassword', 'Model');

/**
 * UsersPassword Test Case
 *
 */
class UsersPasswordTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.users_password',
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
		$this->UsersPassword = ClassRegistry::init('UsersPassword');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsersPassword);

		parent::tearDown();
	}

}
