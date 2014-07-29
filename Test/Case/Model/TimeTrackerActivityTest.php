<?php
App::uses('TimeTrackerActivity', 'TimeTracker.Model');

/**
 * TimeTrackerActivity Test Case
 *
 */
class TimeTrackerActivityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.time_tracker.time_tracker_activity',
		'plugin.time_tracker.user',
		'plugin.time_tracker.time_tracker_customer',
		'plugin.time_tracker.time_tracker_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TimeTrackerActivity = ClassRegistry::init('TimeTracker.TimeTrackerActivity');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TimeTrackerActivity);

		parent::tearDown();
	}

}
