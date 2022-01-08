<?php

class registerController extends Controller
{

    public function index()
    {
        $this->view->render();
        if (!empty($_POST)) {
            $action = $_POST['action'];
            if ($action == 'register') {
                $this->user->signUpUsers($_POST['signUpForm']);
            }

        }

    }
}
