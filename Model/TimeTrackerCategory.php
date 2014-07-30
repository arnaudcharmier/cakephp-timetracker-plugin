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


    //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'ParentTimeTrackerCategory' => array(
            'className' => 'TimeTrackerCategory',
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
            'className' => 'TimeTrackerActivity',
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
            'className' => 'TimeTrackerCategory',
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
