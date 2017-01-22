<?php

class Model_Canvas extends \Orm\Model
{
	protected static $_properties = array(
		'id' => array(
        	'data_type' => 'int',
        ),
		'start_x' => array(
        	'data_type' => 'int',
        ),
		'start_y' => array(
        	'data_type' => 'int',
        ),
		'end_x' => array(
        	'data_type' => 'int',
        ),
		'end_y' => array(
        	'data_type' => 'int',
        ),
		'color',
		'alpha',
		'diameter',
		'room_id' => array(
        	'data_type' => 'int',
        ),
		'status_id' => array(
        	'data_type' => 'int',
        ),
		'session_id' => array(
        	'data_type' => 'int',
        ),
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
		'Orm\\Observer_Typing' => array(
			'events' => array('after_load')
		),
	);

	protected static $_table_name = 'canvases';
	
	protected static $_to_array_exclude = array(
  		'created_at', 'updated_at'	// 出力からこれらのカラムを除外します
  	);

}
