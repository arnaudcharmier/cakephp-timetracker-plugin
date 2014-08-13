<?php
App::uses('TimeTrackerAppController', 'TimeTracker.Controller');
/**
 * TimeTrackerActivities Controller
 *
 * @property TimeTrackerActivity $TimeTrackerActivity
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TimeTrackerActivitiesController extends TimeTrackerAppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', 'Session');

    public $paginate = array(
        'limit' => 25,
        'contain' => array('User')
    );

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->TimeTrackerActivity->recursive = 0;
        $this->set('timeTrackerActivities', $this->Paginator->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->TimeTrackerActivity->exists($id)) {
            throw new NotFoundException(__('Invalid time tracker activity'));
        }

        // Recherche des TimeTrackerActivity et Users
        $conditions = array(
            'TimeTrackerActivity.id' => $id

        );
        $order  = array('TimeTrackerActivity.date ASC');
        $fields = array(
            'TimeTrackerActivity.id',
            'TimeTrackerActivity.date',
            'TimeTrackerActivity.duration',
            'TimeTrackerActivity.comment',
            'TimeTrackerActivity.created',
            'TimeTrackerActivity.modified',
            'TimeTrackerCategory.id',
            'TimeTrackerCategory.name',
            Configure::read('user.model') . '.id',
            Configure::read('user.model') . '.' . Configure::read('user.firstname'),
            Configure::read('user.model') . '.' . Configure::read('user.lastname'),
            'TimeTrackerCustomer.id',
            'TimeTrackerCustomer.name',

        );

        $joins  = array(
            array(
                'table' => Configure::read('user.table'),
                'alias' => Configure::read('user.model'),
                'type' => 'inner',
                'foreignKey' => false,
                'conditions' => array(
                    'TimeTrackerActivity.user_id = ' . Configure::read('user.model') . '.id',
                ),
            ),
            array(
                'table' => 'time_tracker_categories',
                'alias' => 'TimeTrackerCategory',
                'type' => 'inner',
                'foreignKey' => false,
                'conditions' => array(
                    'TimeTrackerActivity.time_tracker_category_id = TimeTrackerCategory.id',
                ),
            ),
            array(
                'table' => 'time_tracker_customers',
                'alias' => 'TimeTrackerCustomer',
                'type' => 'inner',
                'foreignKey' => false,
                'conditions' => array(
                    'TimeTrackerActivity.time_tracker_customer_id = TimeTrackerCustomer.id',
                ),
            ),
        );

        $TimeTrackerActivity    = ClassRegistry::init('TimeTracker.TimeTrackerActivity');
        $timeTrackerActivity = $TimeTrackerActivity->find('first', array('conditions' => $conditions, 'order' => $order, 'fields' => $fields, 'joins' => $joins));
        $this->set(compact('timeTrackerActivity'));
    }

/**
 * add method
 *
 * @return void
 */
    public function add($date = null, $customer_id = null) {

        // Recovery activities that date
        $activitiesUserByDate = array();
        $dateFilter = '';
        $totalTimeWorked = '00:00:00';

        if(!empty($date)){
            $conditions = array(
                'TimeTrackerActivity.date'    => $date,
                'TimeTrackerActivity.user_id' => $this->Auth->user('id'),
            );
            $order  = array('TimeTrackerActivity.date ASC');
            $fields = array(
                'TimeTrackerActivity.id',
                'TimeTrackerActivity.date',
                'TimeTrackerActivity.duration',
                'TimeTrackerActivity.comment',
                'TimeTrackerActivity.created',
                'TimeTrackerActivity.modified',
                'TimeTrackerCategory.id',
                'TimeTrackerCategory.name',
            );

            $joins  = array(
                array(
                    'table' => 'time_tracker_categories',
                    'alias' => 'TimeTrackerCategory',
                    'type' => 'inner',
                    'foreignKey' => false,
                    'conditions' => array(
                        'TimeTrackerActivity.time_tracker_category_id = TimeTrackerCategory.id',
                    ),
                ),
            );
            $activitiesUserByDate = $this->TimeTrackerActivity->find('all', array('conditions' => $conditions, 'order' => $order, 'joins' => $joins, 'fields' => $fields));

            // Calculating total time worked
            foreach ($activitiesUserByDate as $activityUserByDate) {
                $totalTimeWorked = TimeUtil::additionTime($totalTimeWorked, $activityUserByDate['TimeTrackerActivity']['duration']);
            }

            $dateFilter = $date;


        }
        if ($this->request->is('post')) {

            $dataToSave = $this->request->data;
            if(empty($date)){
                if(is_array($dataToSave['TimeTrackerActivity']['date'])) {
                    $date = $dataToSave['TimeTrackerActivity']['date']['year'] . '-' . $dataToSave['TimeTrackerActivity']['date']['month'] . '-' . $dataToSave['TimeTrackerActivity']['date']['day'];
                } else {
                    $date = $dataToSave['TimeTrackerActivity']['date'];
                }
            }
            // Recovery time remaining for this date
            $durationAll = $this->TimeTrackerActivity->durationToDayByUser($date, $this->Auth->user('id'));
            $timeLeft    = TimeUtil::subtractionTime(Configure::read('hoursInWorkDay'), $durationAll);


            // Prepare array
            $dataToSave['TimeTrackerActivity']['user_id']  = $this->Auth->user('id');
            if(!is_array($dataToSave['TimeTrackerActivity']['date'])){
                $dataToSave['TimeTrackerActivity']['date']     = CakeTime::format('Y-m-d', $dataToSave['TimeTrackerActivity']['date']);
            }
            if($dataToSave['TimeTrackerActivity']['duration'] > $timeLeft) {
                $this->Session->setFlash(__('The seizure duration is greater than the time remaining on that date. Please, try again.'), 'flash', array('type' => 'error'));
                $this->data = $dataToSave;
            } else {
                $this->TimeTrackerActivity->create();
                if ($this->TimeTrackerActivity->save($dataToSave)) {
                    $this->Session->setFlash(__('The time tracker activity has been saved.'), 'flash', array('type' => 'success'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $dataToSave['TimeTrackerActivity']['date']     = CakeTime::format('Y-m-d', $dataToSave['TimeTrackerActivity']['date']);
                    $this->data = $dataToSave;
                    $this->Session->setFlash(__('The time tracker activity could not be saved. Please, try again.'), 'flash', array('type' => 'error'));
                }
            }

        }
        $timeTrackerCustomers = $this->TimeTrackerActivity->TimeTrackerCustomer->find('list');
        $timeTrackerCategories = $this->TimeTrackerActivity->TimeTrackerCategory->generateTreeList(null, null, null, '　');
        if(isset($customer_id)) {
            $data['TimeTrackerActivity']['time_tracker_customer_id'] = $customer_id;
            $this->data = $data;
        }

        $this->set(compact('timeTrackerCustomers', 'timeTrackerCategories', 'activitiesUserByDate', 'dateFilter', 'totalTimeWorked'));
    }

/**
 * edit method
 *a
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->TimeTrackerActivity->exists($id)) {
            throw new NotFoundException(__('Invalid time tracker activity'));
        }

        $timeTrackerActivity = $this->TimeTrackerActivity->findById($id, array('fields' => 'user_id'));

        if($this->Auth->user('id') != $timeTrackerActivity['TimeTrackerActivity']['user_id']){
            $this->data = $dataToSave;
            $this->Session->setFlash(__('You can not change what he does not belong to you.'), 'flash', array('type' => 'error'));
            return $this->redirect($this->referer());
        }

        $totalTimeWorked = '00:00:00';

        if(!empty($date)){
            $conditions = array(
                'TimeTrackerActivity.date'    => $date,
                'TimeTrackerActivity.user_id' => $this->Auth->user('id'),
            );
            $order  = array('TimeTrackerActivity.date ASC');
            $fields = array(
                'TimeTrackerActivity.id',
                'TimeTrackerActivity.date',
                'TimeTrackerActivity.duration',
                'TimeTrackerActivity.comment',
                'TimeTrackerActivity.created',
                'TimeTrackerActivity.modified',
                'TimeTrackerCategory.id',
                'TimeTrackerCategory.name',
            );

            $joins  = array(
                array(
                    'table' => 'time_tracker_categories',
                    'alias' => 'TimeTrackerCategory',
                    'type' => 'inner',
                    'foreignKey' => false,
                    'conditions' => array(
                        'TimeTrackerActivity.time_tracker_category_id = TimeTrackerCategory.id',
                    ),
                ),
            );
            $activitiesUserByDate = $this->TimeTrackerActivity->find('all', array('conditions' => $conditions, 'order' => $order, 'joins' => $joins, 'fields' => $fields));

            // Calculating total time worked
            foreach ($activitiesUserByDate as $activityUserByDate) {
                $totalTimeWorked = TimeUtil::additionTime($totalTimeWorked, $activityUserByDate['TimeTrackerActivity']['duration']);
            }

            $dateFilter = $date;


        }

        if ($this->request->is(array('post', 'put'))) {

            $dataToSave = $this->request->data;
            $dataToSave['TimeTrackerActivity']['user_id'] = $this->Auth->user('id');
            if(!is_array($dataToSave['TimeTrackerActivity']['date'])){
                $dataToSave['TimeTrackerActivity']['date']     = CakeTime::format('Y-m-d', $dataToSave['TimeTrackerActivity']['date']);
            }

            // Recovery time remaining for this date
            $durationAll = $this->TimeTrackerActivity->durationToDayByUser($date, $this->Auth->user('id'));
            $timeLeft    = TimeUtil::subtractionTime(Configure::read('hoursInWorkDay'), $durationAll);

            if($dataToSave['TimeTrackerActivity']['duration'] > $timeLeft) {
                $this->Session->setFlash(__('The seizure duration is greater than the time remaining on that date. Please, try again.'), 'flash', array('type' => 'error'));
                $this->data = $dataToSave;
            } else {
                $this->TimeTrackerActivity->create();
                if ($this->TimeTrackerActivity->save($dataToSave)) {
                    $this->Session->setFlash(__('The time tracker activity has been saved.'), 'flash', array('type' => 'success'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $dataToSave['TimeTrackerActivity']['date']     = CakeTime::format('Y-m-d', $dataToSave['TimeTrackerActivity']['date']);
                    $this->data = $dataToSave;
                    $this->Session->setFlash(__('The time tracker activity could not be saved. Please, try again.'), 'flash', array('type' => 'error'));
                }
            }
        } else {
            $options = array('conditions' => array('TimeTrackerActivity.' . $this->TimeTrackerActivity->primaryKey => $id));
            $this->request->data = $this->TimeTrackerActivity->find('first', $options);
            if ($this->request->data['TimeTrackerActivity']['date']) {
                $this->request->data['TimeTrackerActivity']['date'] = $this->request->data['TimeTrackerActivity']['date_humanized'];
            }
        }

        $users = $this->TimeTrackerActivity->User->find('list');
        $timeTrackerCustomers = $this->TimeTrackerActivity->TimeTrackerCustomer->find('list');
        $timeTrackerCategories = $this->TimeTrackerActivity->TimeTrackerCategory->generateTreeList(null, null, null, '　');

        $this->set(compact('timeTrackerCustomers', 'timeTrackerCategories', 'totalTimeWorked'));
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->TimeTrackerActivity->id = $id;
        if (!$this->TimeTrackerActivity->exists()) {
            throw new NotFoundException(__('Invalid time tracker activity'));
        }

        $timeTrackerActivity = $this->TimeTrackerActivity->findById($id, array('fields' => 'user_id'));
        if($this->Auth->user('id') != $timeTrackerActivity['TimeTrackerActivity']['user_id']){
            $this->Session->setFlash(__('You can not delete what is not yours.'), 'flash', array('type' => 'error'));
            return $this->redirect($this->referer());
        }

        if ($this->TimeTrackerActivity->delete()) {
            $this->Session->setFlash(__('The time tracker activity has been deleted.'), 'flash', array('type' => 'success'));
        } else {
            $this->Session->setFlash(__('The time tracker activity could not be deleted. Please, try again.'), 'flash', array('type' => 'error'));
        }
        return $this->redirect($this->referer());
    }
}
