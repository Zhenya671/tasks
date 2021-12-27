<?php

function unsetValue(Array $array, $n) {

    if ($n < 0 || $n > count($array) - 1) {
        return false;
    }

        unset($array[$n]);
        foreach ($array as $value) {
            $arr[] = $value;
        }

    return $arr;

}

$arrays = [1,2,3,4,5];

print_r(unsetValue($arrays,4));

