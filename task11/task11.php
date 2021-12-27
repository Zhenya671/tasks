<?php

class SingletonExampleParent
{


    private function __construct()
    {
        // Do nothing because that's a singleton class
    }

    private function __clone()
    {
        // Do nothing because that's a singleton class
    }

    public static function getInstance(): ?SingletonExampleParent
    {
        static $_instance = null;

        if (!isset($_instance)) {

            $_instance = new static();

        }

        return  $_instance;

    }
}

class SingletonExampleChild extends SingletonExampleParent {}


$o = SingletonExampleParent::getInstance();
$obj = SingletonExampleChild::getInstance();

var_dump($obj);
var_dump($o);

