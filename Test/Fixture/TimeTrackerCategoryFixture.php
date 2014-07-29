<?php
/**
 * TimeTrackerCategoryFixture
 *
 */
class TimeTrackerCategoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false),
		'comment' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'parent_id' => array('type' => 'integer', 'null' => true),
		'lft' => array('type' => 'integer', 'null' => true),
		'rght' => array('type' => 'integer', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'time_tracker_categories_name' => array('unique' => true, 'column' => 'name')
		),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'name' => 'Lorem ipsum dolor sit amet',
			'comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'parent_id' => 1,
			'lft' => 1,
			'rght' => 1,
			'created' => '2014-07-29 17:39:46',
			'modified' => '2014-07-29 17:39:46'
		),
	);

}
