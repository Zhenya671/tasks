<?php

function mondaysFromTo(){

    $test = new DateTime("1.1.1900");
    $test1 = new DateTime("31.12.1999");
    while($test <= $test1 ){

        echo $test->modify('first monday')->format('d.m.Y').'<br>';
        $test->modify("+1 month")->format('d.m.Y');

    }

}

mondaysFromTo();


