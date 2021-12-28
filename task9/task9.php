<?php

function findSumThree(Array $array,int $int): array
{

    $newArr = [];

    for ($i=0;$i <= count($array)-1; $i++) {

        $first = $array[$i];
        $second = $array[$i+1];
        $third = $array[$i+2];
        $sum =  $first + $second + $third;


        if ((!empty($first)) && (!empty($second)) && (!empty($third)) && ($int == $sum)){

                $newArr[] = $int;

        }

    }

    return $newArr;

}

$array = [2, 7, 7, 1, 8, 2, 7, 8, 7];
$int = 16;

print_r(findSumThree($array, $int));
