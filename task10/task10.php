<?php

function implementCollatz(int $int): array
{

    $int2 = 2;
    $array = [$int];

    while ($int != 1){

        if ($int % $int2 == 0) {

            $int = $int/2;
            $array[] = $int;

        }

        if ($int % $int2 != 0) {

            if ($int == 1) {
                break;
            }

            $int = 3 * $int + 1;
            $array[] = $int;

        }

    }

    return $array;

}

print_r(implementCollatz(12));

