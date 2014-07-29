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
		$options = array('conditions' => array('TimeTrackerActivity.' . $this->TimeTrackerActivity->primaryKey => $id));
		$this->set('timeTrackerActivity', $this->TimeTrackerActivity->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TimeTrackerActivity->create();
			if ($this->TimeTrackerActivity->save($this->request->data)) {
				$this->Session->setFlash(__('The time tracker activity has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The time tracker activity could not be saved. Please, try again.'));
			}
		}
		$users = $this->TimeTrackerActivity->User->find('list');
		$timeTrackerCustomers = $this->TimeTrackerActivity->TimeTrackerCustomer->find('list');
		$timeTrackerCategories = $this->TimeTrackerActivity->TimeTrackerCategory->find('list');
		$this->set(compact('users', 'timeTrackerCustomers', 'timeTrackerCategories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TimeTrackerActivity->exists($id)) {
			throw new NotFoundException(__('Invalid time tracker activity'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TimeTrackerActivity->save($this->request->data)) {
				$this->Session->setFlash(__('The time tracker activity has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The time tracker activity could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TimeTrackerActivity.' . $this->TimeTrackerActivity->primaryKey => $id));
			$this->request->data = $this->TimeTrackerActivity->find('first', $options);
		}
		$users = $this->TimeTrackerActivity->User->find('list');
		$timeTrackerCustomers = $this->TimeTrackerActivity->TimeTrackerCustomer->find('list');
		$timeTrackerCategories = $this->TimeTrackerActivity->TimeTrackerCategory->find('list');
		$this->set(compact('users', 'timeTrackerCustomers', 'timeTrackerCategories'));
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
		$this->request->allowMethod('post', 'delete');
		if ($this->TimeTrackerActivity->delete()) {
			$this->Session->setFlash(__('The time tracker activity has been deleted.'));
		} else {
			$this->Session->setFlash(__('The time tracker activity could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
