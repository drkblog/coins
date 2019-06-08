<?php
class DenominationsController extends AppController {

	var $name = 'Denominations';

	function index() {
		$this->Denomination->recursive = 0;
		$this->set('denominations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid denomination'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('denomination', $this->Denomination->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Denomination->create();
			if ($this->Denomination->save($this->request->data)) {
				$this->Session->setFlash(__('The denomination has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The denomination could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid denomination'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Denomination->save($this->request->data)) {
				$this->Session->setFlash(__('The denomination has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The denomination could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Denomination->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for denomination'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Denomination->delete($id)) {
			$this->Session->setFlash(__('Denomination deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Denomination was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>