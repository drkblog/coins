<?php
class TypesController extends AppController {

	var $uses = array('Type', 'Coin');
	var $helpers = array('Boolean', 'NumFormat', 'Text', 'Coin');
	var $components = array('PImage', 'Filter.Filter', 'RequestHandler');
	public $paginate = array();
	var $filters = array  
	(  
	  'index' => array  
	  (  
	    'Type' => array  
	    (  
	      'Type.start_year',
	      'Type.value' => array(
	        'condition' => '=',
	        ),
	      'Denomination.name' => array(
	        'label' => 'Denomination',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Denomination.name ASC'  
	          ),  
	        'required' => false,
	        'filterField' => 'Type.denomination_id',
	        ),  
	      'Type.mint_mark',
	      'Type.km',  
	      'Country.name' => array(
	        'label' => 'Country',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Country.name ASC'  
	          ),  
	        'required' => false,
	        'filterField' => 'Type.country_id',
	        ),
	      'Territory.name' => array(
	        'required' => false,
	        'label' => 'Territory',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Territory.name ASC'  
	          ),  
	        'filterField' => 'Type.territory_id',
	        ),
	      'Emission.name' => array(
	        'label' => 'Emission',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Emission.name ASC'  
	          ),  
	        'required' => false,
	        'filterField' => 'Type.emission_id',
	        ),
	      )  
	    ),
	  'missing' => array  
	  (  
	    'Type' => array  
	    (  
	      'Type.start_year',
	      'Type.value' => array(
	        'condition' => '=',
	        ),
	      'Denomination.name' => array(
	        'label' => 'Denomination',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Denomination.name ASC'  
	          ),  
	        'required' => false,
	        'filterField' => 'Type.denomination_id',
	        ),  
	      'Type.mint_mark',
	      'Type.km',  
	      'Country.name' => array(
	        'label' => 'Country',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Country.name ASC'  
	          ),  
	        'required' => false,
	        'filterField' => 'Type.country_id',
	        ),
	      'Territory.name' => array(
	        'required' => false,
	        'label' => 'Territory',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Territory.name ASC'  
	          ),  
	        'filterField' => 'Type.territory_id',
	        ),
	      'Emission.name' => array(
	        'label' => 'Emission',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Emission.name ASC'  
	          ),  
	        'required' => false,
	        'filterField' => 'Type.emission_id',
	        ),
	      )  
	    ),
	  );
	
	function index() {
    if ($this->RequestHandler->isAjax()) {
      $this->Type->recursive = 0;
      $this->set('types', array('types' => $this->paginate()));
    }
    else {
      $this->Type->recursive = 0;
      $this->set('types', $this->paginate());
    }
	}
	
	function missing() {
		if ($this->Auth->user('group_id') == GRP_VIEWER)
      $this->paginate['joins'] = array(
          array('table' => 'coins',
              'alias' => 'Coin',
              'type' => 'LEFT',
              'conditions' => array(
                'Coin.type_id = Type.id',
                'Coin.user_id' => $this->Session->read('ViewCatalog'),
              )
          )
      );
		else {
      $this->paginate['joins'] = array(
          array('table' => 'coins',
              'alias' => 'Coin',
              'type' => 'LEFT',
              'conditions' => array(
                'Coin.type_id = Type.id',
                'Coin.user_id' => $this->Auth->user('id'),
              )
          )
      );
		}
    $this->paginate['conditions'] = array('Coin.id IS NULL');
    $this->set('types', $this->paginate('Type'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid type'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('type', $this->Type->read(null, $id));
		if ($this->Auth->user('group_id') == GRP_VIEWER)
		  $this->set('coins', $this->Coin->find('all', array('conditions' => array('type_id' => $id, 'user_id' => $this->Session->read('ViewCatalog')))));
		else
		  $this->set('coins', $this->Coin->find('all', array('conditions' => array('type_id' => $id, 'user_id' => $this->Auth->user('id')))));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Type->create();
			if ($this->Type->save($this->request->data)) {
 			  if (isset($this->request->data['Type']['file']['name']) && strlen($this->request->data['Type']['file']['name'])) {
          $file = $this->request->data['Type']['file']['name'];
          if (file_exists(WWW_ROOT.'files/type/'.$this->Type->id.DS.$file)) {
            $thumb = WWW_ROOT.'files/type/'.$this->Type->id.DS.'thumb_'.$file;
            $this->PImage->resizeImage('resize', $file, WWW_ROOT.'files/type/'.$this->Type->id.DS, 'thumb_'.$file, 90, 45);
          }
        }
				$this->Session->setFlash(__('The type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The type could not be saved. Please, try again.'));
			}
		}
		$countries = $this->Type->Country->find('list');
		$territories = $this->Type->Territory->find('list');
		$emissions = $this->Type->Emission->find('list', array('order' => array('country_id', 'start_year')));
		$denominations = $this->Type->Denomination->find('list');
		$this->set(compact('countries', 'emissions', 'denominations', 'territories'));
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid type'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Type->save($this->request->data)) {
 			  if (isset($this->request->data['Type']['image']['name']) && strlen($this->request->data['Type']['image']['name'])) {
          $file = $this->request->data['Type']['image']['name'];
          if (file_exists(WWW_ROOT.'files/type/'.$this->Type->id.DS.$file)) {
            $thumb = WWW_ROOT.'files/type/'.$this->Type->id.DS.'thumb_'.$file;
            @unlink($thumb);
            $this->PImage->resizeImage('resize', $file, WWW_ROOT.'files/type/'.$this->Type->id.DS, 'thumb_'.$file, 90, 45);
          }
        }
				$this->Session->setFlash(__('The type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The type could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Type->read(null, $id);
		}
		$countries = $this->Type->Country->find('list');
		$territories = $this->Type->Territory->find('list', array('conditions' => array('Territory.country_id' => $this->request->data['Type']['country_id'])));
		$emissions = $this->Type->Emission->find('list', array('conditions' => array('Emission.country_id' => $this->request->data['Type']['country_id']),
		                                                        'order' => array('start_year')));
		$denominations = $this->Type->Denomination->find('list');
		$this->set(compact('countries', 'emissions', 'denominations', 'image', 'territories'));
	}

  function bulk_images() {
		if (!empty($this->request->data)) {
		  if (isset($this->request->data['Bulk']['file']['name']) && strlen($this->request->data['Bulk']['file']['name'])) {
		    $zipPath = realpath($this->request->data['Bulk']['file']['tmp_name']);
		    $result[]="Got $zipPath";
		    $zip = new ZipArchive;
		    $zip->open($zipPath);
		    $tmpdir = sys_get_temp_dir().'/bulkimg_'.session_id().'/';
		    @rmdir($tmpdir);
		    mkdir($tmpdir);
		    $zip->extractTo($tmpdir);
		    $old_umask = umask(0000);
		    $result[]="Extracted ".$zip->numFiles." files";
		    for ($i=0; $i<$zip->numFiles;$i++) {
		      $info = $zip->statIndex($i);
		      $file = $tmpdir.$info['name'];
		      if (preg_match('/(.*)\.[^\.]+/', $info['name'], $m))
		        $id = $m[1];
		      if (is_numeric($id)) {
		        // Por ID
		        $type = $this->Type->find('first', array('conditions' => array('Type.id' => $id)));
		      }
		      else {
		        // Por label
		        $type = $this->Type->find('first', array('conditions' => array('Type.label' => $id)));
		      }
		      if ($type && $type['Type']['id'] > 0) {
            if (file_exists($file)) {
              $result[]="Got $file";
              $this->removeLocalPathToImage($this->Type, $type['Type']['id']);
              mkdir(WWW_ROOT.'files/type/'.$type['Type']['id']);
              rename($file, WWW_ROOT.'files/type/'.$type['Type']['id'].DS.$info['name']);
              $result[]="Moved to ".WWW_ROOT.'files/type/'.$coin['Type']['id'].DS.$info['name'];
              $thumb = WWW_ROOT.'files/type/'.$type['Type']['id'].DS.'thumb_'.$info['name'];
              $this->PImage->resizeImage('resize', $info['name'], WWW_ROOT.'files/type/'.$type['Type']['id'].DS, 'thumb_'.$info['name'], 90, 45);
              $this->Type->id = $type['Type']['id'];
              $this->Type->saveField('image', $info['name']);
            }
          }
          else {
            $result[]="Can't find a type identified by $id";
            @unlink($file);
          }
		    }
		    umask($old_umask);
		    $zip->close(); 
		    @rmdir($tmpdir);
		    $this->set('result', $result);
		  }
    }
	}

	function duplicate($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid type'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Type->save($this->request->data)) {
				$this->Session->setFlash(__('The type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The type could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Type->read(null, $id);
			$this->request->data['Type']['id'] = null;
			$this->request->data['Type']['image'] = null;
			$this->request->data['Type']['file_size'] = null;
			$this->request->data['Type']['file_type'] = null;
		}
		$countries = $this->Type->Country->find('list');
		$emissions = $this->Type->Emission->find('list');
		$denominations = $this->Type->Denomination->find('list');
		$this->set(compact('countries', 'emissions', 'denominations'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for type'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Type->delete($id)) {
      $this->removeLocalPathToImage($this->Type, $id);
			$this->Session->setFlash(__('Type deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	// AJAX
	function for_emission() {
    if ($this->request->is('ajax')) {
      $emission = 1;
      if (isset($this->request->data['emission']))
        $emission = $this->request->data['emission'];
      
      $this->Type->virtualFields['fullname'] = "CONCAT(Type.value, ' ', Denomination.name, ' [', Type.start_year, '-', IFNULL(Type.end_year, '....'), ']')";
      $types = $this->Type->find('list', array(
                'fields' => 'fullname',
                'conditions' => array('Type.emission_id' => $emission),
                'order' => array('Denomination.value', 'Type.value', 'Type.start_year'),
                'contain' => array('Denomination')
                ));

      $this->set('types', $types);
      $this->set('_serialize', 'types');
    }
	}
}
?>
