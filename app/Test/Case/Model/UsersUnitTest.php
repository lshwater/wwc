<?php
App::uses('UsersUnit', 'Model');

/**
 * UsersUnit Test Case
 *
 */
class UsersUnitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.users_unit',
		'app.unit',
		'app.agency',
		'app.user',
		'app.userloginlog',
		'app.group',
		'app.groups_user',
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
		$this->UsersUnit = ClassRegistry::init('UsersUnit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsersUnit);

		parent::tearDown();
	}

}
