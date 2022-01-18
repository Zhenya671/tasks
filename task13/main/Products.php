<?php

abstract class Products extends Services
{

    protected array $arrayProducts = [
        'TV' => [
            'name' => 'coolTV',
            'manufactures' => 'samsung',
            'release_date' => '11.12.2013',
            'cost' => 1550
        ],
        'Laptop' => [
            'name' => 'coolLaptop',
            'manufactures' => 'samsung',
            'release_date' => '11.12.2014',
            'cost' => 200
        ],
        'MobilePhone' => [
            'name' => 'coolMobilePhone',
            'manufactures' => 'samsung',
            'release_date' => '11.12.2015',
            'cost' => 500
        ],
        'Fridges' => [
            'name' => 'coolFridge',
            'manufactures' => 'samsung',
            'release_date' => '11.12.2016',
            'cost' => 2000
        ],
    ];


}