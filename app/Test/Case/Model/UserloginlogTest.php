<?php
App::uses('Userloginlog', 'Model');

/**
 * Userloginlog Test Case
 *
 */
class UserloginlogTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.userloginlog',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Userloginlog = ClassRegistry::init('Userloginlog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Userloginlog);

		parent::tearDown();
	}

}
