<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> 'mysql:host=148.66.132.29;dbname=rootvite_rswish',
	'hostname' => '148.66.132.29',
	'username' => 'rootvite_rbwish',
	'password' => '8GJ0vAUgJXdT',
	'database' => 'rootvite_rswish',

// 	'dsn'	=> 'mysql:host=148.66.132.29;dbname=rootemop_internal',
// 	'hostname' => '148.66.132.29',
// 	'username' => 'rootemop_haxto',
// 	'password' => '_v7fmKv3}5M9',
// 	'database' => 'rootemop_internal',

	'dbdriver' => 'pdo',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
