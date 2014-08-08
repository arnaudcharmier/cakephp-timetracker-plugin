<?php
App::uses('TimeTrackerAppModel', 'TimeTracker.Model');
/**
 * TimeTrackerCategory Model
 *
 * @property TimeTrackerCategory $ParentTimeTrackerCategory
 * @property TimeTrackerActivity $TimeTrackerActivity
 * @property TimeTrackerCategory $ChildTimeTrackerCategory
 */
class TimeTrackerCategory extends TimeTrackerAppModel {

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'name';
/**
 * ActsAs
 *
 * @var string
 */
    public $actsAs = array('Tree');

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
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'ParentTimeTrackerCategory' => array(
            'className' => 'TimeTracker.TimeTrackerCategory',
            'foreignKey' => 'parent_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
/**
 * hasMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'TimeTrackerActivity' => array(
            'className' => 'TimeTracker.TimeTrackerActivity',
            'foreignKey' => 'time_tracker_category_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'ChildTimeTrackerCategory' => array(
            'className' => 'TimeTracker.TimeTrackerCategory',
            'foreignKey' => 'parent_id',
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
