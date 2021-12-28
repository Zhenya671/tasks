<?php

function Compare(int $int): string
{

    return $int > 30 ? "int more than 30" : ($int > 20 ? "int more than 20 and less than 30" : ($int > 10 ? "int more than 10 and less than 10" : "int less than 10"));

}

print Compare(33);
