<?php session_start();

function __autoload($class) {
    $classPath = dirname(__FILE__) . '/classes';
    include_once ($classPath . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
}

$config = array();

# database config
$config['db']['dsn'] = 'mysql:host=127.0.0.1;dbname=vitrinepix_challenge';
$config['db']['user'] = 'root';
$config['db']['pass'] = '1234';