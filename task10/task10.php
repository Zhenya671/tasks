<?php

function implementCollatz(int $int)
{

    $int2 = 2;
    $array = [$int];

    if ($int <= 0){

        echo 'the number cannot be less than or equal to 0';
        return false;

    }

    while ($int != 1){

        if ($int % $int2 == 0) {

            $int = $int/2;

        } elseif ($int % $int2 != 0) {

            $int = 3 * $int + 1;

        }

        $array[] = $int;

    }

    return $array;

}

print_r(implementCollatz(12));
