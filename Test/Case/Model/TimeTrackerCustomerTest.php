<?php
App::uses('TimeTrackerCustomer', 'TimeTracker.Model');

/**
 * TimeTrackerCustomer Test Case
 *
 */
class TimeTrackerCustomerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.time_tracker.time_tracker_customer',
		'plugin.time_tracker.time_tracker_activity'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TimeTrackerCustomer = ClassRegistry::init('TimeTracker.TimeTrackerCustomer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TimeTrackerCustomer);

		parent::tearDown();
	}

}
