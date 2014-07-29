<?php
App::uses('TimeTrackerCategory', 'TimeTracker.Model');

/**
 * TimeTrackerCategory Test Case
 *
 */
class TimeTrackerCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.time_tracker.time_tracker_category',
		'plugin.time_tracker.time_tracker_activity'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TimeTrackerCategory = ClassRegistry::init('TimeTracker.TimeTrackerCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TimeTrackerCategory);

		parent::tearDown();
	}

}
