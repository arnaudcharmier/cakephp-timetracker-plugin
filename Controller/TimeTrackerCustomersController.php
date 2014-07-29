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
		$options = array('conditions' => array('TimeTrackerCustomer.' . $this->TimeTrackerCustomer->primaryKey => $id));
		$this->set('timeTrackerCustomer', $this->TimeTrackerCustomer->find('first', $options));
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
		$this->request->allowMethod('post', 'delete');
		if ($this->TimeTrackerCustomer->delete()) {
			$this->Session->setFlash(__('The time tracker customer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The time tracker customer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
