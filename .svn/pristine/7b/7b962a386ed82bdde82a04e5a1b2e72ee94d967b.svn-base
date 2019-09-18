<?php
App::uses('Notification', 'Model');

/**
 * Notification Test Case
 *
 */
class NotificationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.notification',
		'app.user',
		'app.userloginlog',
		'app.users_password',
		'app.users_userinputfield',
		'app.userinputfield',
		'app.inputtype',
		'app.selectionlist',
		'app.selectionitem',
		'app.group',
		'app.groups_user',
		'app.menu',
		'app.menucategory',
		'app.groups_menu',
		'app.unit',
		'app.agency',
		'app.users_unit'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Notification = ClassRegistry::init('Notification');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notification);

		parent::tearDown();
	}

}
