<?php
App::uses('TimeTrackerAppModel', 'TimeTracker.Model');
/**
 * TimeTrackerCustomer Model
 *
 * @property TimeTrackerActivity $TimeTrackerActivity
 */
class TimeTrackerCustomer extends TimeTrackerAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
        'name' => array(
            'name' => array(
                'rule' => 'notEmpty',
                'message' => 'Thank you to enter a name.',
                'allowEmpty' => false,
                'required' => true,
            ),
        ),
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TimeTrackerActivity' => array(
			'className' => 'TimeTracker.TimeTrackerActivity',
			'foreignKey' => 'time_tracker_customer_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
