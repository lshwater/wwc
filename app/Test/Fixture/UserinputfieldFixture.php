<?php
/**
 * UserinputfieldFixture
 *
 */
class UserinputfieldFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'title' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'inputtype_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'selectionlist_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'group' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'title' => 1,
			'inputtype_id' => 1,
			'selectionlist_id' => 1,
			'group' => 1
		),
	);

}
