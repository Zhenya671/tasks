<?php
ini_set('precision',301);

function fiboWith100Digits(): string
{

    $one = 0;
    $two = 1;

    for ($i = 1; $i <= 1000; $i++) {
        $current = $one + $two;

        $one = $two;
        $two = $current;

        if (strlen($current) >= 100) {

            break;

        }

    }

    $array = str_split($current);

    return implode('', $array);
}

print fiboWith100Digits();