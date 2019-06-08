<?php
App::uses('AppController', 'Controller');
/**
 * Territories Controller
 *
 * @property Territory $Territory
 */
class TerritoriesController extends AppController {

	var $components = array('Filter.Filter');
	
	var $filters = array  
	(  
	  'index' => array  
	  (  
	    'Territory' => array('Territory.name',
	      'Country.name' => array(
	        'label' => 'Country',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Country.name ASC'  
	          ),  
	        'required' => false,
	        'filterField' => 'Territory.country_id',
	        ),  
	      )
	    )
	);
  
	function isAuthorized() {
    if (parent::isAuthorized()) {
      return true;
    }

    if ($this->request->action === 'index') {
      return true;
    }

    return false;
  }
  
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Territory->recursive = 0;
		$this->set('territories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Territory->exists($id)) {
			throw new NotFoundException(__('Invalid territory'));
		}
		$options = array('conditions' => array('Territory.' . $this->Territory->primaryKey => $id));
		$this->set('territory', $this->Territory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($country_id = null) {
		if ($this->request->is('post')) {
			$this->Territory->create();
			if ($this->Territory->save($this->request->data)) {
				$this->Session->setFlash(__('The territory has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The territory could not be saved. Please, try again.'));
			}
		}
		$countries = $this->Territory->Country->find('list');
		$this->set(compact('countries', 'country_id'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Territory->exists($id)) {
			throw new NotFoundException(__('Invalid territory'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Territory->save($this->request->data)) {
				$this->Session->setFlash(__('The territory has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The territory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Territory.' . $this->Territory->primaryKey => $id));
			$this->request->data = $this->Territory->find('first', $options);
		}
		$countries = $this->Territory->Country->find('list');
		$this->set(compact('countries'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Territory->id = $id;
		if (!$this->Territory->exists()) {
			throw new NotFoundException(__('Invalid territory'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Territory->delete()) {
			$this->Session->setFlash(__('Territory deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Territory was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	// AJAX
	function for_country() {
    if ($this->request->is('ajax')) {
      $country = 1;
      if (isset($this->request->data['country']))
        $country = $this->request->data['country'];
        
      $territories = $this->Territory->find('list', array('conditions' => array('Territory.country_id' => $country),
                                                        'order' => array('name' => 'asc')));
      $this->set('territories', $territories);
      $this->set('_serialize', 'territories');
		}
	}
	
}
