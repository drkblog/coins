<?php
class Emission extends AppModel {

  var $displayField = "full_name";
  public $virtualFields = array('full_name' => 'CONCAT(Emission.name, " [", Emission.start_year, "-", IFNULL(Emission.end_year, "XXXX"), "]")');
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Enter a name for this emission',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength', 150),
				'message' => 'The name must be less than 150 characters long.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minlength' => array(
				'rule' => array('minlength', 2),
				'message' => 'The name must be more than two characters long.',
				//'allowEmpty' => false,
				//'required' => false,
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
	);
}
?>
