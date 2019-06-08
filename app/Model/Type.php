<?php
class Type extends AppModel {
	var $name = 'Type';
	var $virtualFields = array(
	  'name' => "CONCAT(Type.value, ' ', ' [', Type.start_year, '-', IFNULL(Type.end_year, '....'), ']')"
	  );
	var $displayField = 'name';
	var $validate = array(
		'value' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'You have to enter a decimal value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'start_year' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter first emission year',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'end_year' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter last emission year',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'mint_mark' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'commemorative' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'error' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		'km' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $belongsTo = array(
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			),
		'Territory' => array(
			'className' => 'Territory',
			'foreignKey' => 'territory_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			),
		'Emission' => array(
			'className' => 'Emission',
			'foreignKey' => 'emission_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			),
		'Denomination' => array(
			'className' => 'Denomination',
			'foreignKey' => 'denomination_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)
		);
	
	var $hasMany = array(
		'Coin' => array(
			'className' => 'Coin',
			'foreignKey' => 'type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
			)
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
	
	// Corrección para columnas calculadas en find
	function afterFind($results, $primary=false) {
	  if($primary == true) {
	    if(Set::check($results, '0.0')) {
	      $fieldName = key($results[0][0]);
	      foreach($results as $key=>$value) {
	        $results[$key][$this->alias][$fieldName] = $value[0][$fieldName];
	        unset($results[$key][0]);
	      }
	    }
	  }
	  
	  return $results;
	}
}
?>
