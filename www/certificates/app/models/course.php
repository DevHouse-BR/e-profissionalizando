<?php
class Course extends AppModel {
	var $name = 'Course';
	var $actsAs = array(
		'MeioUpload' => array(
			'imagem' => array(
				'dir' => 'pics',
				'create_directory' => true,
				'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/png'),
				'allowed_ext' => array('.jpg', '.jpeg', '.png'),
				'thumbsizes' => array(
					'big' => array('width'=>1123, 'height'=>794, 'zoomCrop'=>false),
					'normal' => array('width'=>1123, 'height'=>794),
					'small' => array('width'=>80, 'height'=>80, 'zoomCrop'=>true),
				),
				'default' => 'default.jpg',
			)
		)
	);
	var $validate = array(
		'nome' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Preencha o campo acima',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'carga' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Preencha o campo acima',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'valor' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Preencha o campo acima',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Client' => array(
			'className' => 'Client',
			'joinTable' => 'clients_courses',
			'foreignKey' => 'course_id',
			'associationForeignKey' => 'client_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>