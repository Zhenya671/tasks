<?php

class Route {

    public function showForm(){
        if (trim($_SERVER['REQUEST_URI'], '/') == 'upload'){
            return include ROOT . '/upload.php';
        }
        return include ROOT . '/view/index.php';
    }

}