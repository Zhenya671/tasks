<?php


require_once("model/File.php");
require_once("logger/Logger.php");


$object = new File();

if (isset($_POST['submit'])) {
    $file = $_FILES['upload'];
    $object
        ->set($file)
        ->maxSize(100)
        ->type()
        ->executableType()
        ->diskFreeCheck($file)
        ->name('newFile')
        ->directory("uploads");

    if ($object->upload()) {

        echo 'Upload successful<br>';
        $object->showInfo();
        Logger::file($object->getError(), $file);

    } else {
        $object->report();
    }


}