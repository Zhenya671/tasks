<?php

class User
{

    protected string $email;
    protected string $password;
    protected string $name = '';

    public array $dbUsers;

    protected array $errorsValidate = [];

    public function __construct()
    {

        $this->email = $_POST['email'];
        $this->password = $_POST['password'];

        $this->dbUsers = $this->getUsers();

        $this->output();

    }

    public function getUsers()
    {

        return include 'db.php';

    }

    public function output(): bool
    {

        if ($this->validateSignIn($this->email, $this->password) === true) {

            echo 'Welcome back, ' . $this->name;

        }

        return false;


    }

    public function validateSignIn($email, $password): bool
    {

        $this->validateNotNull($email, $password);
        $this->validateEmail($email);
        $this->validatePassword($password);
        $this->searchUserByEmail($email);
        $this->checkPassword($email, $password);

        if ($this->errorsValidate != null) {

            foreach ($this->errorsValidate as $errors) {

                print $errors . '<br>';

            }

            return false;

        }
        return true;

    }

    public function checkPassword($email, $password): bool
    {

        $hashPassword = $this->hashPassword($password);

        foreach ($this->dbUsers as $key => $value) {
            if ($key === $email && password_verify($value['password'], $hashPassword) === true) {
                return true;
            }
        }

        $this->errorsValidate[] = 'incorrect password';
        return false;

    }

    public function hashPassword($password): string
    {

        return password_hash($password, PASSWORD_DEFAULT);

    }

    public function searchUserByEmail($email): bool
    {

        foreach ($this->dbUsers as $key => $value) {

            if ($key == $email) {
                $this->name .= $value['name'];
                return true;
            }
        }
        $this->errorsValidate[] = 'incorrect login';
        return false;

    }

    public function validateNotNull($email, $password): bool
    {

        if ($email == null && $password == null) {
            $this->errorsValidate[] = 'please fill all fields';
            return false;
        }

        return true;

    }

    public function validateEmail($email): bool
    {

        if (preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $email) == 0) {
            $this->errorsValidate[] = '"' . $email . '"does not match format email';
            return false;
        }
        return true;

    }

    public function validatePassword($password): bool
    {

        if (strlen($password) < 4) {
            $this->errorsValidate[] = 'password does not match less than 4 symbols';
            return false;
        }
        return true;
    }

}

if (isset($_POST['email']) && $_POST['password']) {

    $obj = new User();

} else {
    echo 'please go back to the previous page and fill out the fields';
}

