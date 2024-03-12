<?php
require 'environment.php';

$config = array();

if (ENVIRONMENT == 'development') {
	define('BASE_URL', 'http://localhost/lojadamagia');
	$config['dbname'] = 'magicstore';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define('BASE_URL', 'http://www.meusite.com');
	$config['dbname'] = 'magicstore';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}

global $db;
try {
	$db = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['dbuser'], $config['dbpass']);
} catch (PDOException $e) {
	die($e->getMessage());
}
