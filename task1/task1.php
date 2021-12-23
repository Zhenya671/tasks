<?php

function Compare($int){

    switch ($int){
        case $int > 30:
            echo 'int more than 30';
            break;
        case 30:
            echo 'int = 30';
            break;
        case $int < 30 && $int > 20:
            echo 'int less than 30 but more than 20';
            break;
        case 20:
            echo 'int = 20';
            break;
        case $int < 20 && $int > 10:
            echo 'int less than 20 but more than 10';
            break;
        case 10:
            echo 'int = 10';
            break;
        default:
            echo 'int less than 10';
            break;
    }

}
Compare(25);

