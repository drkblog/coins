<?php
class Coin extends AppModel {
	var $name = 'Coin';
	var $displayField = 'label';
	var $validate = array(
		'label' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Enter a label (location) for this coin.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			'maxlength' => array(
				'rule' => array('maxlength', 50),
				'message' => 'Label must be less than 50 characters long.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'year' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter face year',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'mint_mark' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 10),
				'message' => 'Mint mark can be up to 10 characters long.',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'restored' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'cleaned' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'dirty' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'damaged' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'possible_error' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'for_sale' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'value' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Current value',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'bought_for' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Acquisition cost',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		);

	var $actsAs = array(
	  'Upload.Upload' => array(
	    'image' => array(
	      'path' => '{ROOT}{DS}webroot{DS}files{DS}{model}{DS}',
	      'mimetypes' => array('image/jpeg', 'image/pjpeg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png','image/x-png'),
	      'maxSize' => '500000', //bytes OR false to turn off maxFileSize (default false)
	      )
	    )
	  );

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			),
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			),
		'Grade' => array(
			'className' => 'Grade',
			'foreignKey' => 'grade_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)
		);
	
  public function isOwnedBy($id, $user) {
    return $this->field('id', array('id' => $id, 'user_id' => $user)) === $id;
  }

	
	// Para filtrar por "has image"
	function afterDataFilter($query, $options) {
	  
	  if ($query['conditions'] != null && array_key_exists('Coin.has_image', $query['conditions']) && $query['conditions']['Coin.has_image'] == '1') {
	    //var_dump($query['conditions']);
	    $query['conditions'] = array_merge($query['conditions'],
	      array (
	        "not" => array (
	          "Coin.image" => null,
	          )
	        )
	      );
	  }
	  else if ($query['conditions'] != null && array_key_exists('Coin.has_image', $query['conditions']) && $query['conditions']['Coin.has_image'] == '0') {
	    $query['conditions'] = array_merge($query['conditions'],
	      array ("Coin.image" => null)
	      );
	  }
	  unset($query['conditions']['Coin.has_image']);
	  
	  return $query;
	}
}
?>
