<?php
class EmissionsController extends AppController {

	var $components = array('Filter.Filter', 'RequestHandler');
	var $filters = array  
	(  
	  'index' => array  
	  (  
	    'Emission' => array  
	    (  
	      'Emission.name',  
	      'Country.name' => array(
	        'label' => 'Country',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Country.name ASC'  
	          ),  
	        'required' => false,
	        'filterField' => 'Emission.country_id',
	        ),  
	      ),  
	      'Territory.name' => array(
	        'label' => 'Territory',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Territory.name ASC'  
	          ),  
	        'required' => false,
	        'filterField' => 'Emission.territory_id',
	        ),  
	    )  
	  );  

	function index() {
		$this->Emission->recursive = 0;
		$this->set('emissions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid emission'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('emission', $this->Emission->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Emission->create();
			if ($this->Emission->save($this->request->data)) {
				$this->Session->setFlash(__('The emission has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emission could not be saved. Please, try again.'));
			}
		}
		$countries = $this->Emission->Country->find('list');
		$territories = $this->Emission->Territory->find('list');
		$this->set(compact('countries', 'territories'));
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid emission'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Emission->save($this->request->data)) {
				$this->Session->setFlash(__('The emission has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The emission could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Emission->read(null, $id);
		}
		$countries = $this->Emission->Country->find('list');
		$territories = $this->Emission->Territory->find('list', array('conditions' => 
		  array('country_id' => $this->request->data['Country']['id'])));
		$this->set(compact('countries', 'territories'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for emission'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Emission->delete($id)) {
			$this->Session->setFlash(__('Emission deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Emission was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	// AJAX
	function for_country() {
    if ($this->request->is('ajax')) {
      $country = 1;
      if (isset($this->request->data['country']))
        $country = $this->request->data['country'];
        
      $emissions = $this->Emission->find('list', array('conditions' => array('Emission.country_id' => $country),
                                                        'order' => array('start_year')));
      $this->set('emissions', $emissions);
      $this->set('_serialize', 'emissions');
    }
	}
}
?>
