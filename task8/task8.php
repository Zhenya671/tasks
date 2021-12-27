<?php

function printJsonDecodeToString($value, $key){

    echo "$key : $value"."<br>";

}

function jsonDecodeToString($json){

$array = json_decode($json, true);
array_walk_recursive($array, 'printJsonDecodeToString');

}
$json = '{
"Title": "The Cuckoos Calling",
"Author": "Robert Galbraith",
"Detail": {
"Publisher": "Little Brown"
}
}';

jsonDecodeToString($json);
