<?php

function findSumThree($array, $int): array
{

    $newArr = [];

    for ($i=0;$i <= count($array)-1; $i++) {

        $sum = $array[$i] + $array[$i+1] + $array[$i+2];

        if ($sum == $int) {

            $newArr[] = $sum;

        }

    }

    return $newArr;

}

$array = [2, 7, 7, 1, 8, 2, 7, 8, 7];
$int = 16;

print_r(findSumThree($array, $int));
