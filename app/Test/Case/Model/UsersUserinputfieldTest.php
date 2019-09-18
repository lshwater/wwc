<?php
App::uses('UsersUserinputfield', 'Model');

/**
 * UsersUserinputfield Test Case
 *
 */
class UsersUserinputfieldTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.users_userinputfield',
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
		'app.selectionitem'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UsersUserinputfield = ClassRegistry::init('UsersUserinputfield');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsersUserinputfield);

		parent::tearDown();
	}

}
