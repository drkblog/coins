<?php
class Grade extends AppModel {
	var $name = 'Grade';
	var $order = 'position';
	var $displayField = 'full_name';
	var $virtualFields = array(
	   'full_name' => 'CONCAT(Grade.acronym, " [", Grade.name, "]")'
	);

	var $validate = array(
		'name' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 100),
				'message' => 'Grade identification must be less than 100 characters long.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Enter grade identification',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'acronym' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 20),
				'message' => 'Grade identification must be less than 20 characters long.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Enter the acronym for this grade',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'position' => array(
			'maxlength' => array(
				'rule' => array('numeric'),
				'message' => 'Enter an integer position.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You have to specify a position',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
?>
