<?php

class Controller
{

    public User $user;
    public View $view;

    public function __construct()
    {
        $this->view = new View();
        $this->user = new User();
    }

}