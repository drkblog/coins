<?php
class GradesController extends AppController {

	var $name = 'Grades';

	function index() {
		$this->Grade->recursive = 0;
		$this->set('grades', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid grade'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('grade', $this->Grade->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Grade->create();
			if ($this->Grade->save($this->request->data)) {
				$this->Session->setFlash(__('The grade has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grade could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid grade'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Grade->save($this->request->data)) {
				$this->Session->setFlash(__('The grade has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grade could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Grade->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for grade'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Grade->delete($id)) {
			$this->Session->setFlash(__('Grade deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Grade was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>