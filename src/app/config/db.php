<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
  'default' => array(
    'type'           => 'mysqli',
    'connection'     => array(
        'hostname'       => getenv('MYSQL_PORT_3306_TCP_ADDR'),
        'port'           => getenv('MYSQL_PORT_3306_TCP_PORT'),
        'database'       => 'fuel_db',
        'username'       => 'root',
        'password'       => 'password',
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
