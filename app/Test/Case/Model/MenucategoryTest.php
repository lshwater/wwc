<?php
App::uses('Menucategory', 'Model');

/**
 * Menucategory Test Case
 *
 */
class MenucategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.menucategory',
		'app.menu',
		'app.group',
		'app.user',
		'app.userloginlog',
		'app.users_userinputfield',
		'app.userinputfield',
		'app.inputtype',
		'app.selectionlist',
		'app.selectionitem',
		'app.groups_user',
		'app.unit',
		'app.agency',
		'app.users_unit',
		'app.groups_menu'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Menucategory = ClassRegistry::init('Menucategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Menucategory);

		parent::tearDown();
	}

}
