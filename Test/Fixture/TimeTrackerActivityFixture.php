<?php
/**
 * TimeTrackerActivityFixture
 *
 */
class TimeTrackerActivityFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'date' => array('type' => 'date', 'null' => false),
		'user_id' => array('type' => 'biginteger', 'null' => false),
		'time_tracker_customer_id' => array('type' => 'biginteger', 'null' => false),
		'time_tracker_category_id' => array('type' => 'biginteger', 'null' => false),
		'duration' => array('type' => 'text', 'null' => false),
		'comment' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'created' => array('type' => 'datetime', 'null' => true),
		'modified' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
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
			'date' => '2014-07-29',
			'user_id' => '',
			'time_tracker_customer_id' => '',
			'time_tracker_category_id' => '',
			'duration' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'comment' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2014-07-29 17:38:49',
			'modified' => '2014-07-29 17:38:49'
		),
	);

}
