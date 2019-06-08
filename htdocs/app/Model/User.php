<?php
class User extends AppModel {
	var $name = 'User';
	var $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $actsAs = array('Acl' => array('type' => 'requester'));
 
	public function selectCatalog($user_id) {
		$user = $this->find('first', array('conditions' => array('User.id' => $user_id, 'public_catalog' => 1)));
		if ($user) {
		  CakeSession::write('ViewCatalog', $user['User']['id']);
		  CakeSession::write('Catalog', $user['User']['username']);
		  return true;
		}
		return false;
	}
	
	public function parentNode() {
	    if (!$this->id && empty($this->data)) {
		return null;
	    }
	    if (isset($this->data['User']['group_id'])) {
	      $groupId = $this->data['User']['group_id'];
	    } else {
	      $groupId = $this->field('group_id');
	    }
	    if (!$groupId) {
	      return null;
	    } else {
	      return array('Group' => array('id' => $groupId));
	    }
	}

}
?>
