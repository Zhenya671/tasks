<?php

abstract class Services
{

    protected array $arrayServices = [
        'Warranty' => [
            'deadline' => '31.12.2021',
            'runQueue' => '',
            'cost' => 50
        ],
        'Delivery' => [
            'deadline' => '15:00 01.01.2022',
            'runQueue' => '',
            'cost' => 15
        ],
        'Install' => [
            'deadline' => '16:00 01.01.2022',
            'runQueue' => '',
            'cost' => 150
        ],
        'Configure' => [
            'deadline' => '17:00 01.01.2022',
            'runQueue' => '',
            'cost' => 25
        ],
    ];

}