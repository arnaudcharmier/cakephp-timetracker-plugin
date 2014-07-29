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
		$this->TimeTrackerCategory->recursive = 0;
		$this->set('timeTrackerCategories', $this->Paginator->paginate());
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
		$options = array('conditions' => array('TimeTrackerCategory.' . $this->TimeTrackerCategory->primaryKey => $id));
		$this->set('timeTrackerCategory', $this->TimeTrackerCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TimeTrackerCategory->create();
			if ($this->TimeTrackerCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The time tracker category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The time tracker category could not be saved. Please, try again.'));
			}
		}
		$parentTimeTrackerCategories = $this->TimeTrackerCategory->ParentTimeTrackerCategory->find('list');
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
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TimeTrackerCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The time tracker category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The time tracker category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TimeTrackerCategory.' . $this->TimeTrackerCategory->primaryKey => $id));
			$this->request->data = $this->TimeTrackerCategory->find('first', $options);
		}
		$parentTimeTrackerCategories = $this->TimeTrackerCategory->ParentTimeTrackerCategory->find('list');
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
		$this->request->allowMethod('post', 'delete');
		if ($this->TimeTrackerCategory->delete()) {
			$this->Session->setFlash(__('The time tracker category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The time tracker category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
