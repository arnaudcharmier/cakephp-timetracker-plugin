<?php
App::uses('TimeTrackerAppController', 'TimeTracker.Controller');
/**
 * TimeTrackerCategories Controller
 *
 * @property TimeTrackerCategory $TimeTrackerCategory
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TimeTrackerCategoriesController extends TimeTrackerAppController {

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
        $timeTrackerCategories = $this->TimeTrackerCategory->generateTreeList(null, null, null, '　');
        $this->set(compact('timeTrackerCategories'));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->TimeTrackerCategory->exists($id)) {
            throw new NotFoundException(__('Invalid time tracker category'));
        }


        $timeTrackerCategory = $this->TimeTrackerCategory->find('first', array(
            'conditions' => array(
                'TimeTrackerCategory.' . $this->TimeTrackerCategory->primaryKey => $id
            )
        ));

        $timeTrackerCategoryChildren = $this->TimeTrackerCategory->children($id);

        // Recherche des TimeTrackerActivity et Users
        $conditions = array(
            'TimeTrackerActivity.time_tracker_category_id' => $id

        );
        $order  = array('TimeTrackerActivity.date ASC');
        $fields = array(
            'TimeTrackerActivity.id',
            'TimeTrackerActivity.date',
            'TimeTrackerActivity.duration',
            'TimeTrackerActivity.created',
            'TimeTrackerActivity.modified',
            'TimeTrackerCategory.name',
            'TimeTrackerCustomer.name',
            Configure::read('user.model') . '.firstname',
            Configure::read('user.model') . '.lastname',

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
        $timeTrackerActivities = $TimeTrackerActivity->find('all', array('conditions' => $conditions, 'order' => $order, 'fields' => $fields, 'joins' => $joins));

        $this->set(compact('timeTrackerCategory', 'timeTrackerActivities', 'timeTrackerCategoryChildren'));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        $dataToSave = $this->request->data;

        if ($this->request->is('post')) {
            $this->TimeTrackerCategory->create();
            if ($this->TimeTrackerCategory->save($dataToSave)) {
                $this->Session->setFlash(__('The time tracker category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The time tracker category could not be saved. Please, try again.'));
            }
        }
        $parentTimeTrackerCategories = $this->TimeTrackerCategory->ParentTimeTrackerCategory->generateTreeList(null, null, null, '　');
        $this->set(compact('parentTimeTrackerCategories'));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->TimeTrackerCategory->exists($id)) {
            throw new NotFoundException(__('Invalid time tracker category'));
        }

        $dataToSave = $this->request->data;

        if ($this->request->is(array('post', 'put'))) {
            if ($this->TimeTrackerCategory->save($dataToSave)) {
                $this->Session->setFlash(__('The time tracker category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The time tracker category could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('TimeTrackerCategory.' . $this->TimeTrackerCategory->primaryKey => $id));
            $this->request->data = $this->TimeTrackerCategory->find('first', $options);
        }
        $parentTimeTrackerCategories = $this->TimeTrackerCategory->ParentTimeTrackerCategory->generateTreeList(null, null, null, '　');
        $this->set(compact('parentTimeTrackerCategories'));
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {

        $this->TimeTrackerCategory->id = $id;

        if (!$this->TimeTrackerCategory->exists()) {
            throw new NotFoundException(__('Invalid time tracker category'));
        }

        // Find related activity
        $activitiesCategory = $this->TimeTrackerCategory->TimeTrackerActivity->find('count', array(
            'conditions' => array('TimeTrackerActivity.time_tracker_category_id' => $id)
        ));

        // Presence of related activity
        if($activitiesCategory > 0){
            $this->Session->setFlash(__('This category is linked with activities. Thank you delete and try again.'));
            return $this->redirect($this->referer());
        }

        // Find child element
        $children = $this->TimeTrackerCategory->children($id, true, array(
            'fields' => 'TimeTrackerCategory.id'
        ));

        // Presence of child element
        if(count($children) != 0){
            $this->Session->setFlash(__('The time tracker category to a child element. Thank you to remove it and try again.'));
            return $this->redirect($this->referer());
        }


        if ($this->TimeTrackerCategory->removeFromTree($id, true)) {
            $this->Session->setFlash(__('The time tracker category has been deleted.'));
        } else {
            $this->Session->setFlash(__('The time tracker category could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

/**
 * moveup method
 *
 * @throws NotFoundException
 * @param string $id
 * @param string $delta
 * @return void
 */

    public function moveup($id = null, $delta = 1) {

        $this->TimeTrackerCategory->id = $id;

        if (!$this->TimeTrackerCategory->exists()) {
            throw new NotFoundException(__('Invalid time tracker category'));
        }

        $this->TimeTrackerCategory->id = $id;

        if(($this->TimeTrackerCategory->moveUp($id, abs($delta))) == false) {
            $this->Session->setFlash(__('This time tracker category can not go above'));
        }
        $this->redirect(array('action' => 'index'));
    }

/**
 * movedown method
 *
 * @throws NotFoundException
 * @param string $id
 * @param string $delta
 * @return void
 */

    public function movedown($id = null, $delta = 1) {

        $this->TimeTrackerCategory->id = $id;

        if (!$this->TimeTrackerCategory->exists()) {
            throw new NotFoundException(__('Invalid time tracker category'));
        }

        $this->TimeTrackerCategory->id = $id;

        if($this->TimeTrackerCategory->moveDown($id, abs($delta)) == false) {
            $this->Session->setFlash(__('This time tracker category can not go lower'));
        }
        $this->redirect(array('action' => 'index'));
    }
}
