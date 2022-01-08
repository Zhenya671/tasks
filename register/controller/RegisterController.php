<?php

class registerController extends Controller
{

    public function index()
    {
        $this->view->render();
//        var_dump( $this->view);
        if (!empty($_POST)) {
            $action = $_POST['action'];
            if ($action == 'register') {
//                echo 'hui';
//                print_r($_POST['signUpForm']);
                $this->user->signUpUsers($_POST['signUpForm']);
            }




        }
//        $this->view->render();


    }
}