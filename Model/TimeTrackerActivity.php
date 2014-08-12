<?php
App::uses('TimeTrackerAppModel', 'TimeTracker.Model');
/**
 * TimeTrackerActivity Model
 *
 * @property User $User
 * @property TimeTrackerCustomer $TimeTrackerCustomer
 * @property TimeTrackerCategory $TimeTrackerCategory
 */
class TimeTrackerActivity extends TimeTrackerAppModel {

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'date' => array(
            'date' => array(
                'rule' => array('date', 'ymd'),
                'message' => 'Thank you to enter a date.',
                'allowEmpty' => false,
                'required' => true,
            ),
        ),
        'duration' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Thank you to enter a duration.',
                'allowEmpty' => true,
                'required' => true,
            ),
        ),
    );

    public $findMethods = array('hoursWorkedPerDay' =>  true, 'hoursWorkedPerUser' => true, 'hoursWorkedPerCategory' =>  true);

    //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'TimeTrackerCustomer' => array(
            'className' => 'TimeTracker.TimeTrackerCustomer',
            'foreignKey' => 'time_tracker_customer_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'TimeTrackerCategory' => array(
            'className' => 'TimeTracker.TimeTrackerCategory',
            'foreignKey' => 'time_tracker_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function afterFind($resultats, $primary = false) {
        parent::afterFind($resultats, $primary);
        App::uses('CakeTime', 'Utility');
        foreach ($resultats as $clef => $val) {
            if (is_array($val) && !empty($val[$this->alias])) {
                if (isset($val[$this->alias]['date'])) {
                    $resultats[$clef][$this->alias]['date_humanized'] = CakeTime::format('d/m/Y ', $val[$this->alias]['date']);
                }
                if (isset($val[$this->alias]['created'])) {
                    $resultats[$clef][$this->alias]['created_humanized'] = CakeTime::format('d/m/Y ', $val[$this->alias]['created']);
                }
                if (isset($val[$this->alias]['modified'])) {
                    $resultats[$clef][$this->alias]['modified_humanized'] = CakeTime::format('d/m/Y ', $val[$this->alias]['modified']);
                }
            }
        }
        return $resultats;
    }

    public function durationToDayByUser($date, $user) {
        // Recovery time remaining for this date
        $conditions = array(
            'TimeTrackerActivity.user_id' => $user,
            'TimeTrackerActivity.date' => $date
        );
        $fields = array(
            'TimeTrackerActivity.duration'
        );
        $timeTrackerActivities = $this->find('all', array('conditions' => $conditions, 'fields' => $fields));

        $timeLeft = '00:00:00';

        foreach ($timeTrackerActivities as $timeTrackerActivity) {
            $timeLeft = TimeUtil::additionTime($timeLeft, $timeTrackerActivity['TimeTrackerActivity']['duration']);
        }

        return $timeLeft;
    }

    protected function _findHoursWorkedPerDay($state, $query, $results = array()) {
        if ($state == 'before') {
            return $query;
        }

        $hoursWorkedPerDay = array();
        foreach ($results as $result) {
            if(empty($hoursWorkedPerDay[$result['TimeTrackerActivity']['date']])){
                $hoursWorkedPerDay[$result['TimeTrackerActivity']['date']] = '00:00:00';
            }

            $hoursWorkedPerDay[$result['TimeTrackerActivity']['date']] = TimeUtil::additionTime($hoursWorkedPerDay[$result['TimeTrackerActivity']['date']], $result['TimeTrackerActivity']['duration']);
        }
        return $hoursWorkedPerDay;
    }

    protected function _findHoursWorkedPerUser($state, $query, $results = array()) {
        if ($state == 'before') {
            return $query;
        }

        $hoursWorkedPerDay = array();
        foreach ($results as $result) {
            $nameUser = $result[Configure::read('user.model')][Configure::read('user.firstname')] . ' ' . $result[Configure::read('user.model')][Configure::read('user.lastname')];
            if(empty($hoursWorkedPerUser[$nameUser])) {
                $hoursWorkedPerUser[$nameUser] = '00:00:00';
            }

            $hoursWorkedPerUser[$nameUser] = TimeUtil::additionTime($hoursWorkedPerUser[$nameUser], $result['TimeTrackerActivity']['duration']);

        }
        return $hoursWorkedPerUser;
    }

    protected function _findHoursWorkedPerCategory($state, $query, $results = array()) {
        if ($state == 'before') {
            return $query;
        }
        $hoursWorkedPerCategory = array();
        foreach ($results as $result) {
            if(empty($hoursWorkedPerCategory[$result['TimeTrackerCategory']['name']])) {
                $hoursWorkedPerCategory[$result['TimeTrackerCategory']['name']] = '00:00:00';
            }

            $hoursWorkedPerCategory[$result['TimeTrackerCategory']['name']] = TimeUtil::additionTime($hoursWorkedPerCategory[$result['TimeTrackerCategory']['name']], $result['TimeTrackerActivity']['duration']);

        }
        return $hoursWorkedPerCategory;
    }
}
