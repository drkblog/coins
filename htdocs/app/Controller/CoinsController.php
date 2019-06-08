<?php
App::uses('AppController', 'Controller');
class CoinsController extends AppController {
  
	var $helpers = array('Boolean', 'Js', 'Html', 'Coin');
	var $components = array('PImage', 'Filter.Filter', 'RequestHandler');
	var $filters = array  
	(  
	  'index' => array  
	  (  
	    'Coin' => array  
	    (  
	      'Coin.label',  
	      'Coin.year' => array(
	        'label' => 'Year',
	        ),  
	      'Type.value' => array(
	        'label' => 'Nominal value',
	        'condition' => '=',
	        'filterField' => 'Type.value',
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
	        'label' => 'Territory',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Territory.name ASC'  
	          ),  
	        'required' => false,
	        'filterField' => 'Type.territory_id',
	        ),
	      'Grade.acronym' => array(
	        'label' => 'Grade',
	        'type' => 'select',  
	        'selectOptions' => array  
	        (  
	          'order' => 'Grade.id ASC'  
	          ),  
	        'required' => false,
	        'filterField' => 'Coin.grade_id',
	        ),  
	      'Coin.possible_error' => array(
	        'label' => 'Possible error',
	        'type' => 'select',  
	        'selector' => 'getBooleanOptions',
	        'filterField' => 'Coin.possible_error',
	        ),  
	      'Coin.for_sale' => array(
	        'label' => 'For sale',
	        'type' => 'select',  
	        'selector' => 'getBooleanOptions',
	        'filterField' => 'Coin.for_sale',
	        ),  
	      'Coin.from' => array(
	        'label' => 'Value (from)',
	        'condition' => '>=',
	        'filterField' => 'Coin.value',
	        ),  
	      'Coin.up_to' => array(
	        'label' => 'Value (up to)',
	        'condition' => '<=',
	        'filterField' => 'Coin.value',
	        ),  
	      'Coin.has_image' => array(
	        'label' => 'Has image',
	        'type' => 'select',  
	        'selector' => 'getBooleanOptions',
	        'filterField' => 'Coin.has_image',
	        ),  
	      )  
	    )  
	  );  
	
	public function beforeFilter() {
	  if ($this->Auth->user('group_id') == GRP_VIEWER) {
	    unset($this->Filter->settings['Coins']['index']['Coin']['Coin.from']);
	    unset($this->Filter->settings['Coins']['index']['Coin']['Coin.up_to']);
	  }
	  parent::beforeFilter();
	}
	
	public function isAuthorized($user = null) {
    if (parent::isAuthorized($user)) {
      return true;
    }

    if (empty($this->request->params['admin'])) {
       return (bool)(
         (in_array($this->request->params['action'], array('deposit')))
           ||
         ($this->Auth->user('group_id') == GRP_COLLECTOR && in_array($this->request->params['action'], array('add')))
           ||
         (in_array($this->request->params['action'], array('move', 'edit', 'delete', 'view', 'clone'))
           &&
          $this->Coin->isOwnedBy($this->request->params['pass'][0], $this->Auth->user('id')))
       );
    }

    return false;
  }
	
	function index() {
		$this->Coin->recursive = 2;
		if ($this->Auth->user('group_id') == GRP_COLLECTOR) {
		  $sum = $this->Coin->find('all', array('fields' => array('sum(Coin.value) AS total'),
		                                        'conditions'=> array('user_id' => $this->Auth->user('id'))));
		  $this->set('total', $sum[0][0]['total']);
			$this->set('coins', $this->paginate(array('user_id' => $this->Auth->user('id'))));
		}
		else if ($this->Auth->user('group_id') == GRP_VIEWER) {
		  $this->set('total', 0.00);
			$this->set('coins', $this->paginate(array('user_id' => $this->Session->read('ViewCatalog'))));
		}
		else {
		  // ADMIN TODO
		  $sum = $this->Coin->find('all', array('fields' => array('sum(Coin.value) AS total'),
		                                        'conditions'=> array('user_id' => $this->Auth->user('id'))));
		  $this->set('total', $sum[0][0]['total']);
			$this->set('coins', $this->paginate(array('user_id' => $this->Auth->user('id'))));
		}
	}
	
	
	function deposit($dock = null, $user_id = null) {
		$this->Coin->recursive = 2;
		if ($dock != null) {
		  
		  $dock = str_replace('-', '.', $dock);
		  
		  if ($this->Auth->user('group_id') == GRP_VIEWER) {
		    if ($user_id != null) {
		      $this->Coin->User->selectCatalog($user_id);
		    }
		    $user_condition = array('user_id' => $this->Session->read('ViewCatalog'));
		  }
		  else
		    $user_condition = array('user_id' => $this->Auth->user('id'));
		    
		  $conditions = array_merge(array('label LIKE' => $dock.'.%'), $user_condition);
		  
      $sum = $this->Coin->find('all', array('fields' => array('sum(Coin.value) AS total'),
                                            'conditions'=> $conditions));
      $coins = $this->Coin->find('all', array('conditions'=> $conditions, 'order' => 'label'));
      $max_col='A';
      $max_row=1;
      foreach ($coins as $coin) {
        if (preg_match('/[A-Z0-9\.]+\.([A-Z]+)([0-9]+)/', $coin['Coin']['label'], $m)) {
          $max_col = ($m[1] > $max_col)?$m[1]:$max_col;
          $max_row = ($m[2] > $max_row)?$m[2]:$max_row;
          $map_coins[$m[1]][$m[2]] = $coin;
        }
      }
      $this->set('count', count($coins));
      $this->set('total', $sum[0][0]['total']);
    }
    else {
      $map_coins = array();
      $max_col = 'A';
      $max_row = 0;
    }
    $this->set(compact('dock', 'map_coins', 'max_col', 'max_row'));
	}
	
	function move($id = null, $dock = null) {
		if (!$id || !$dock) {
			throw new NotFoundException(__('Invalid argument'));
		}
		$this->Coin->id = $id;
		if (!$this->Coin->exists()) {
			throw new NotFoundException(__('Invalid coin'));
		}
		$label = $this->Coin->field('label');
		if (preg_match('/(.*)\.(.*)/', $label, $m)) {
      $new_label = "$m[1].$dock";
      $this->Coin->saveField('label', $new_label);
		}
		$this->redirect($this->referer());
	}
	
	function coin_image($id = null, $thumb = false) {
		$this->Coin->id = $id;
		if (!$this->Coin->exists()) {
			throw new NotFoundException(__('Invalid coin'));
		}
    $this->Coin->read(null, $id);
    if (preg_match('/.*\.(.*)/', $this->Coin->data['Coin']['image'], $m)) {
      $ext = strtolower($m[1]);
      $img = $this->localPathToImage($this->Coin, $this->Coin->data, $thumb);
      switch($ext)
      {
      case 'gif' :
        $image = imagecreatefromgif($img);
        break;
      case 'png' :
        $image = imagecreatefrompng($img);
        imagealphablending($oldImage, false);
        imagesavealpha($oldImage, true);
        $is_png = true;
        break;
      case 'jpg' :
      case 'jpeg' :
        $image = imagecreatefromjpeg($img);
        break;
        default:
        break;
      }
    }
    if ($image != FALSE) {
      if (!$thumb) {
        $text = 'DRK Coin Catalog';
        $font = '../EUROSWH.TTF';
        $black = imagecolorallocatealpha($image, 0, 0, 0, 20);
        $white = imagecolorallocatealpha($image, 255, 255, 255, 20);
        $bbox = imagettfbbox(20, 0, $font, $text);
        $upper_x = (imagesx($image) - abs($bbox[4] - $bbox[0])) / 2;
        $upper_y = 20 + abs($bbox[5] - $bbox[1]);
        imagettftext($image, 20, 0, $upper_x+2, $upper_y+2, $black, $font, $text);
        imagettftext($image, 20, 0, $upper_x, $upper_y, $white, $font, $text);
        $text = $this->Coin->data['Coin']['label'];
        $bbox = imagettfbbox(20, 0, $font, $text);
        $lower_x = (imagesx($image) - abs($bbox[4] - $bbox[0])) / 2;
        $lower_y = imagesy($image) - abs($bbox[5] - $bbox[1]) - 20;
        imagettftext($image, 20, 0, $lower_x+2, $lower_y+2, $black, $font, $text);
        imagettftext($image, 20, 0, $lower_x, $lower_y, $white, $font, $text);
      }    
      $this->autoRender = false;
      $this->response->type($ext);
      ob_start();
      imagejpeg($image);
      $final_image = ob_get_contents();
      ob_end_clean();
    }
    else {
      $this->autoRender = false;
      $this->response->type('png');
      $final_image = readfile('../webroot/img/none.png');
    }
    $this->response->body($final_image);
	}	
	
	function view($id = null, $user_id = null) {
		$this->Coin->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid coin'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Auth->user('group_id') == GRP_COLLECTOR) {
		  if (!$this->Coin->isOwnedBy($id, $this->Auth->user('id'))) {
		    $this->Session->setFlash(__('That\'s not your coin'));
		    $this->redirect(array('action' => 'index'));
		  }
		}
		else if ($this->Auth->user('group_id') == GRP_VIEWER) {
      if ($user_id != null) {
        $this->Coin->User->selectCatalog($user_id);
      }
		  if (!$this->Coin->isOwnedBy($id, $this->Session->read('ViewCatalog'))) {
		    $this->Session->setFlash(__('That\'s not a public coin'));
		    $this->redirect(array('action' => 'index'));
		  }
		}
		$this->set('coin', $this->Coin->read(null, $id));
	}
	
	function add($id = null) {
		if (!empty($this->request->data)) {
			$this->Coin->create();
			$this->request->data['Coin']['user_id'] = $this->Auth->user('id');
			if ($this->Coin->save($this->request->data)) {
 			  if (isset($this->request->data['Coin']['image']['name']) && strlen($this->request->data['Coin']['image']['name'])) {
          $file = $this->request->data['Coin']['image']['name'];
          if (file_exists(WWW_ROOT.'files/coin/'.$this->Coin->id.DS.$file)) {
            $thumb = WWW_ROOT.'files/coin/'.$this->Coin->id.DS.'thumb_'.$file;
            $this->PImage->resizeImage('resize', $file, WWW_ROOT.'files/coin/'.$this->Coin->id.DS, 'thumb_'.$file, 90, 45);
          }
        }
				$this->Session->setFlash(__('The coin has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The coin could not be saved. Please, try again.'));
			}
		}
		$type = $this->Coin->Type->findById((isset($id))?$id:$this->request->data['Coin']['type_id']);
		if (!$type) {
		  $this->Session->setFlash(__('Invalid coin type'));
		  $this->redirect(array('action' => 'index'));
		}
		
		$type_name = $type['Country']['name'].' - '.$type['Type']['value'].' '.$type['Denomination']['name'].' ['.$type['Type']['start_year'].'-'.$type['Type']['end_year'].'] '.$type['Type']['mint_mark'].' km'.$type['Type']['km'];
		$grades = $this->Coin->Grade->find('list');
		$this->set(compact('types', 'grades', 'id', 'type_name'));
	}
	
	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid coin'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Coin->save($this->request->data)) {
 			  if (isset($this->request->data['Coin']['image']['name']) && strlen($this->request->data['Coin']['image']['name'])) {
          $file = $this->request->data['Coin']['image']['name'];
          if (file_exists(WWW_ROOT.'files/coin/'.$this->Coin->id.DS.$file)) {
            $thumb = WWW_ROOT.'files/coin/'.$this->Coin->id.DS.'thumb_'.$file;
            @unlink($thumb);
            $this->PImage->resizeImage('resize', $file, WWW_ROOT.'files/coin/'.$this->Coin->id.DS, 'thumb_'.$file, 90, 45);
          }
        }
				$this->Session->setFlash(__('The coin has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The coin could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Coin->read(null, $id);
		}
		$type_id = $this->request->data['Coin']['type_id'];
		$type = $this->Coin->Type->findById($type_id);
		if (!$type) {
		  $this->Session->setFlash(__('Invalid coin type'));
		  $this->redirect(array('action' => 'index'));
		}
		$type_name = $type['Country']['name'].' - '.$type['Type']['value'].' '.$type['Denomination']['name'].' ['.$type['Type']['start_year'].'-'.$type['Type']['end_year'].'] '.$type['Type']['mint_mark'].' km'.$type['Type']['km'];
		$grades = $this->Coin->Grade->find('list');
		$this->set(compact('types', 'grades', 'type_name', 'type_id'));
	}

	function duplicate($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid coin'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			$this->request->data['Coin']['user_id'] = $this->Auth->user('id');
			if ($this->Coin->save($this->request->data)) {
				$this->Session->setFlash(__('The coin has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The coin could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Coin->read(null, $id);
			$this->request->data['Coin']['id'] = null;
		}
		$type_id = $this->request->data['Coin']['type_id'];
		$type = $this->Coin->Type->findById($type_id);
		if (!$type) {
		  $this->Session->setFlash(__('Invalid coin type'));
		  $this->redirect(array('action' => 'index'));
		}
		$type_name = $type['Country']['name'].' - '.$type['Type']['value'].' '.$type['Denomination']['name'].' ['.$type['Type']['start_year'].'-'.$type['Type']['end_year'].'] '.$type['Type']['mint_mark'];
		$grades = $this->Coin->Grade->find('list');
		$this->set(compact('types', 'grades', 'type_name', 'type_id'));
	}
	
	function changeType($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid coin'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			$new_type = $this->request->data['Coin']['type_id'];
			$this->request->data = $this->Coin->read(null, $this->request->data['Coin']['id']);
			$this->request->data['Coin']['type_id'] = $new_type;
			if ($this->Coin->save($this->request->data)) {
				$this->Session->setFlash(__('The coin type has been changed'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The coin type could not be changed. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
		  $this->Coin->recursive = 2;
		  $this->request->data = $this->Coin->read(null, $id);
		  $countries = $this->Coin->Type->Country->find('list');
		  $this->set(compact('countries'));
		}
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
		        $coin = $this->Coin->find('first', array('conditions' => array('Coin.id' => $id, 'Coin.user_id' => $this->Auth->user('id'))));
		      }
		      else {
		        // Por label
		        $coin = $this->Coin->find('first', array('conditions' => array('Coin.label' => $id, 'Coin.user_id' => $this->Auth->user('id'))));
		      }
		      if ($coin && $coin['Coin']['id'] > 0) {
            if (file_exists($file)) {
              $result[]="Got $file";
              $this->removeLocalPathToImage($this->Coin, $coin['Coin']['id']);
              mkdir(WWW_ROOT.'files/coin/'.$coin['Coin']['id']);
              rename($file, WWW_ROOT.'files/coin/'.$coin['Coin']['id'].DS.$info['name']);
              $result[]="Moved to ".WWW_ROOT.'files/coin/'.$coin['Coin']['id'].DS.$info['name'];
              $thumb = WWW_ROOT.'files/coin/'.$coin['Coin']['id'].DS.'thumb_'.$info['name'];
              $this->PImage->resizeImage('resize', $info['name'], WWW_ROOT.'files/coin/'.$coin['Coin']['id'].DS, 'thumb_'.$info['name'], 90, 45);
              $this->Coin->id = $coin['Coin']['id'];
              $this->Coin->saveField('image', $info['name']);
            }
          }
          else {
            $result[]="Can't find a coin identified by $id";
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
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for coin'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Coin->delete($id)) {
      $this->removeLocalPathToImage($this->Coin, $id);
			$this->Session->setFlash(__('Coin deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Coin was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>
