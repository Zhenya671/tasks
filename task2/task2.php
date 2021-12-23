<?php


function countdownToBirthday($i){

    $curDate = new DateTime("today");
    $birthday = new DateTime($i);

    $birthday->setDate($curDate->format('Y'), $birthday->format('m'),$birthday->format('d'));

    $dif = $curDate->diff($birthday);
    if ($dif->invert){
        $birthday->modify('+1 year');
        $dif = $curDate->diff($birthday);
    }
    echo $dif->days;

}

countdownToBirthday('03.02.2003');
