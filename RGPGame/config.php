<?php

function __autoload($class) {
    $classPath = dirname(__FILE__) . '/classes';
    include_once ($classPath . '/' . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
}