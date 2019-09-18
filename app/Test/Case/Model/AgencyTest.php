<?php
App::uses('Agency', 'Model');

/**
 * Agency Test Case
 *
 */
class AgencyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.agency',
		'app.unit'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Agency = ClassRegistry::init('Agency');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Agency);

		parent::tearDown();
	}

}
