<?php

function findSumThree(array $array, int $int): array
{

    $newArr = [];

    for ($i = 0; $i <= count($array) - 1; $i++) {

        if ((!empty($array[$i])) && (!empty($array[$i + 1])) && (!empty($array[$i + 2])) && ($int == $array[$i] + $array[$i + 1] + $array[$i + 2])) {

            $first = $array[$i];
            $second = $array[$i + 1];
            $third = $array[$i + 2];
            $sum = $first + $second + $third;

            echo "$first + $second + $third = $sum" . '<br>';
            $newArr[] = $int;

        }

    }

    return $newArr;

}

$array = [2, 7, 7, 1, 8, 2, 7, 8, 7];
$int = 16;

print_r(findSumThree($array, $int));


