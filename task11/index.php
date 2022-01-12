<?php

require_once 'task11.php';

$o = SingletonExampleParent::getInstance();
$obj = SingletonExampleChild::getInstance();

var_dump($obj);
var_dump($o);