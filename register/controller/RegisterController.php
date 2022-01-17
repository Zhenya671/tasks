<?php

class RegisterController extends Controller
{

    public function actionIndex()
    {
        $this->view->render();
    }

    public function actionRegister()
    {
        $this->user->signUpUsers($_POST['signUpForm']);
    }
}