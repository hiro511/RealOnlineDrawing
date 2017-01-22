<?php
/**
 * The staging database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
    'type'           => 'mysqli',
    'connection'     => array(
        'hostname'       => getenv('MYSQL_PORT_3306_TCP_ADDR'),
        'port'           => getenv('MYSQL_PORT_3306_TCP_PORT'),
        'database'       => 'fuel_db',
        'username'       => 'dev',
        'password'       => 'pass',
        'persistent'     => false,
        'compress'       => false,
    ),
    'identifier'     => '`',
    'table_prefix'   => '',
    'charset'        => 'utf8',
    'enable_cache'   => true,
    'profiling'      => false,
    'readonly'       => false,
  ),
);
