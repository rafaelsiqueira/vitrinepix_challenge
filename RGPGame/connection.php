<?php
require_once 'config.php';

global $dbh;

#
$dbh = new PDO($dsn, $config['db']['user'], $config['db']['pass']);
