<?php
class CountriesController extends AppController {

	var $components = array('Filter.Filter');
	
	var $filters = array  
	(  
	  'index' => array  
	  (  
	    'Country' => array('Country.name'),
	  )
	);


	function index() {
		$this->Country->recursive = 0;
		$this->set('countries', $this->paginate());
	}

	function isAuthorized() {
    if (parent::isAuthorized()) {
      return true;
    }

    if ($this->request->action === 'index') {
      return true;
    }

    return false;
  }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid country'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('country', $this->Country->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Country->create();
			if ($this->Country->save($this->request->data)) {
				$this->Session->setFlash(__('The country has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The country could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid country'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Country->save($this->request->data)) {
				$this->Session->setFlash(__('The country has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The country could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Country->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for country'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Country->delete($id)) {
			$this->Session->setFlash(__('Country deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Country was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>