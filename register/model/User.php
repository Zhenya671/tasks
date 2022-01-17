<?php

class User extends Model
{

    public array $errorsValidate = [];

    public function signUpUsers($signUpForm): bool
    {

        $this->validateForSignUp($signUpForm);
        if (!empty($this->errorsValidate)) {
            foreach ($this->errorsValidate as $errors) {
                echo $errors . '<br>';
            }
            return false;

        } else {
            echo 'user register success';
            $this->registerNewUser($signUpForm['email'], $signUpForm['firstName'], $signUpForm['lastName'], $signUpForm['password']);
            return true;

        }
    }

    public function registerNewUser($email, $firstName, $lastName, $password)
    {
        $sql = "INSERT INTO Users(email, first_name, last_name, password, created_date)
				VALUES (:email, :first_name, :last_name, :password, NOW())
		";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":first_name", $firstName);
        $stmt->bindValue(":last_name", $lastName);
        $stmt->bindValue(":password", $password);

        try {
            $this->db->beginTransaction();
            $stmt->execute();
            $this->db->commit();

        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Error: " . $e->getMessage();
        }

    }

    public function validateForSignUp($signUpForm)
    {

        $signUpForm = $this->validateNotNull($signUpForm);
        $this->validateEmail($signUpForm['email'], $signUpForm['confirmEmail']);
        $this->validatePassword($signUpForm['password'], $signUpForm['confirmPassword']);

    }

    public function validateNotNull(array $param): array
    {

        $newParam = [];
        $nullFlaf = false;
        foreach ($param as $key => $value) {
            $value = trim($value);
            if (strlen($value) == 0) {
                $nullFlaf = true;
            }

            $newParam[$key] = $value;
        }

        if ($nullFlaf) {
            $this->errorsValidate[] = 'Please fill in all fields';
        }

        return $newParam;

    }

    public function validateEmail($email, $confirmEmail): bool
    {

        if ($email !== $confirmEmail) {
            $this->errorsValidate[] = 'mismatch email';
            return false;
        }
        return true;

    }

    public function validatePassword($password, $confirm_password): bool
    {

        if ($password !== $confirm_password) {

            $this->errorsValidate[] = 'Passwords mismatch';

        } elseif (preg_match("/(?=.*[0-9])/", $password) == 0) {
            $this->errorsValidate[] = 'password should contain min 1 number';

        } elseif (preg_match("/(?=.*[!@#$%^&*])/", $password) == 0) {
            $this->errorsValidate[] = 'password should contain min 1 special char';

        } elseif (preg_match("/(?=.*[a-z])/", $password) == 0) {
            $this->errorsValidate[] = 'password should contain min 1 lowercase letter';

        } elseif (preg_match("/(?=.*[A-Z])/", $password) == 0) {
            $this->errorsValidate[] = 'password should contain min 1 uppercase letter';

        } elseif (preg_match("/[0-9a-zA-Z!@#$%^&*]/", $password) == 0) {
            $this->errorsValidate[] = 'please fill correctly';

        } elseif (strlen($password) < 6) {

            $this->errorsValidate[] = "field password must not be shorter than 6";

        }

        if (!empty($this->errorsValidate)) {
            return false;
        }

        return true;

    }

}