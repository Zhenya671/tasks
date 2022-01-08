<?php

class Routing {

    public static function buildRoute() {

        $controllerName = "IndexController";
        $action = "index";

        $route = explode("/", $_SERVER['REQUEST_URI']);
        if($route[1] != '') {
            $controllerName = ucfirst($route[1]. "Controller");
        }

        if(isset($route[2]) && $route[2] !='') {
            $action = $route[2];
        }

        $controller = new $controllerName();
        $controller->$action();

    }


}