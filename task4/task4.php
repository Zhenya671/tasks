<?php

function validate(String $string): string
{

    $whatNeedToReplace = ['-', '_'];
    $stringWithOutTireAndNP = str_replace($whatNeedToReplace,' ',$string);
    $array = explode(' ',$stringWithOutTireAndNP);

        for ($i = 0; $i <= count($array)-1; $i++) {

            $array[$i] = ucfirst($array[$i]);

        }

    return implode($array);
}

print validate('The quick-brown_fox jumps over the_lazy-dog');