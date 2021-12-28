<?php

function mondaysFromTo(): bool
{

    $dateFrom = new DateTime("1.1.1900");
    $dateTo = new DateTime("31.12.1999");

    while($dateFrom->format('m-Y') < $dateTo->format('m-Y') ){

        if ($dateFrom->format('D') == 'Mon'){

            $dates[] = clone $dateFrom;

        }

        $dateFrom->modify("+1 month")->format('d.m.Y');

    }

    foreach ($dates as $date) {
        echo $date->format('d.m.Y').'<br>';
    }

    return false;

}

mondaysFromTo();
