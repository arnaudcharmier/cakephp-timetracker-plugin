<?php
App::uses('TimeTrackerAppController', 'TimeTracker.Controller');
/**
 * TimeTrackerCustomers Controller
 *
 * @property TimeTrackerCustomer $TimeTrackerCustomer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TimeTrackerCustomersController extends TimeTrackerAppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->TimeTrackerCustomer->recursive = 0;
        $this->set('timeTrackerCustomers', $this->Paginator->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->TimeTrackerCustomer->exists($id)) {
            throw new NotFoundException(__('Invalid time tracker customer'));
        }
        $timeTrackerCustomer = $this->TimeTrackerCustomer->find('first', array('conditions' => array('TimeTrackerCustomer.' . $this->TimeTrackerCustomer->primaryKey => $id)));

        // Recherche des TimeTrackerActivity et Users
        $conditions = array(
            'TimeTrackerActivity.time_tracker_customer_id' => $id

        );
        $order  = array('TimeTrackerActivity.date ASC');
        $fields = array(
            'TimeTrackerActivity.id',
            'TimeTrackerActivity.date',
            'TimeTrackerActivity.duration',
            'TimeTrackerActivity.comment',
            'TimeTrackerActivity.created',
            'TimeTrackerActivity.modified',
            'TimeTrackerCategory.name',
            Configure::read('user.model') . '.firstname',
            Configure::read('user.model') . '.lastname',

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
        );

        $TimeTrackerActivity    = ClassRegistry::init('TimeTracker.TimeTrackerActivity');
        $timeTrackerActivities = $TimeTrackerActivity->find('all', array('conditions' => $conditions, 'order' => $order, 'fields' => $fields, 'joins' => $joins));

        // On prépare le tableau pour cal-heatmap
        $dateYearBefore = strftime("%y-%m-%d", mktime(0, 0, 0, '01', '01', date('y') - 1));

        $activityCustomerByDays = $TimeTrackerActivity->find('all', array(
            'conditions' => array('TimeTrackerActivity.date >' => $dateYearBefore)
        ));

        $activitiesCustomerByDay = $TimeTrackerActivity->find('hoursWorkedPerDay', array(
            'conditions' => array(
                'TimeTrackerActivity.time_tracker_customer_id' => $id
            )
        ));

        $joinsUser = array(
            array(
                'table' => Configure::read('user.table'),
                'alias' => Configure::read('user.model'),
                'type' => 'inner',
                'foreignKey' => false,
                'conditions' => array(
                    'TimeTrackerActivity.user_id = ' . Configure::read('user.model') . '.id',
                ),
            )
        );
        $fieldsUser = array(
            'TimeTrackerActivity.id',
            'TimeTrackerActivity.duration',
            Configure::read('user.model') . '.firstname',
            Configure::read('user.model') . '.lastname',

        );
        $activitiesCustomerByUser = $TimeTrackerActivity->find('hoursWorkedPerUser', array(
            'conditions' => array(
                'TimeTrackerActivity.time_tracker_customer_id' => $id
            ),
            'joins' => $joinsUser,
            'fields' => $fieldsUser
        ));

        $joinsCat = array(
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
        $fieldsCat = array(
            'TimeTrackerActivity.id',
            'TimeTrackerActivity.duration',
            'TimeTrackerCategory.name',

        );
        $activitiesCustomerByCategory = $TimeTrackerActivity->find('hoursWorkedPerCategory', array(
            'conditions' => array(
                'TimeTrackerActivity.time_tracker_customer_id' => $id
            ),
            'joins' => $joinsCat,
            'fields' => $fieldsCat
        ));

        $this->set(compact('timeTrackerCustomer', 'timeTrackerActivities', 'activitiesCustomerByDay', 'activitiesCustomerByUser', 'activitiesCustomerByCategory'));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->TimeTrackerCustomer->create();
            if ($this->TimeTrackerCustomer->save($this->request->data)) {
                $this->Session->setFlash(__('The time tracker customer has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The time tracker customer could not be saved. Please, try again.'));
            }
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->TimeTrackerCustomer->exists($id)) {
            throw new NotFoundException(__('Invalid time tracker customer'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->TimeTrackerCustomer->save($this->request->data)) {
                $this->Session->setFlash(__('The time tracker customer has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The time tracker customer could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('TimeTrackerCustomer.' . $this->TimeTrackerCustomer->primaryKey => $id));
            $this->request->data = $this->TimeTrackerCustomer->find('first', $options);
        }
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->TimeTrackerCustomer->id = $id;
        if (!$this->TimeTrackerCustomer->exists()) {
            throw new NotFoundException(__('Invalid time tracker customer'));
        }
        if ($this->TimeTrackerCustomer->delete()) {
            $this->Session->setFlash(__('The time tracker customer has been deleted.'));
        } else {
            $this->Session->setFlash(__('The time tracker customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
