<?php

namespace App;

/**
 * class Authentication contains implements login
 * and register methods with validation data
 */
class Authentication
{

    /**
     * @var Database object of class Database
     */
    private Database $database;

    /**
     * @var Session object of class Session
     */
    private Session $session;

    /**
     * @param Database $database object of class Database
     * @param Session $session object of class Session
     */
    public function __construct(Database $database, Session $session)
    {
        $this->database = $database;
        $this->session = $session;
    }

    /**
     * register new user in database
     *
     * @param array $data contains data from register form
     * @return bool
     * @throws AuthenticationException
     */
    public function register(array $data): bool
    {
        if (empty($data['firstname'])) {

            throw new AuthenticationException('the firstname should not be empty');

        } elseif (empty($data['lastname'])) {

            throw new AuthenticationException('the lastname should not be empty');

        } elseif (empty($data['email'])) {

            throw new AuthenticationException('the email should not be empty');

        } elseif ($data['confirmEmail'] !== $data['email']) {

            throw new AuthenticationException('the email mismatch');

        } elseif (empty($data['password'])) {

            throw new AuthenticationException('the password should not be empty');

        } elseif ($data['confirmPassword'] !== $data['password']) {

            throw new AuthenticationException('the password mismatch');

        } elseif (preg_match("/(?=.*[0-9])/", $data['password']) == 0) {

            throw new AuthenticationException('password should contain min 1 number');

        } elseif (preg_match("/(?=.*[!@#$%^&*])/", $data['password']) == 0) {

            throw new AuthenticationException('password should contain min 1 special char');

        } elseif (preg_match("/(?=.*[a-z])/", $data['password']) == 0) {

            throw new AuthenticationException('password should contain min 1 lowercase letter');


        } elseif (preg_match("/(?=.*[A-Z])/", $data['password']) == 0) {

            throw new AuthenticationException('password should contain min 1 uppercase letter');

        } elseif (preg_match("/[0-9a-zA-Z!@#$%^&*]/", $data['password']) == 0) {

            throw new AuthenticationException('please fill correctly');

        } elseif (strlen($data['password']) < 6) {

            throw new AuthenticationException('field password must not be shorter than 6');

        }
        $statement = $this->database->getConnection()->prepare(
            'SELECT * FROM Users WHERE email = :email'
        );
        $statement->execute([
            'email' => $data['email']
        ]);

        $user = $statement->fetch();

        if (!empty($user)) {
            throw new AuthenticationException('User with such email already register');
        }

        $statement = $this->database->getConnection()->prepare(
            "INSERT INTO Users(email, first_name, last_name, password, created_date)
				VALUES (:email, :first_name, :last_name, :password, NOW())"
        );
        $statement->execute([
            'email' => $data['email'],
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);

        return true;
    }

    /**
     * login already logged user
     *
     * @param string $email contains a user email
     * @param $password mixed contains a user password
     * @return bool
     * @throws AuthenticationException
     */
    public function login(string $email, $password): bool
    {
        if (empty($email)) {

            throw new AuthenticationException('the email should not be empty');

        } elseif (empty($password)) {

            throw new AuthenticationException('the password should not be empty');

        }

        $statement = $this->database->getConnection()->prepare(
            'SELECT * FROM Users WHERE email = :email'
        );
        $statement->execute([
            'email' => $email
        ]);

        $user = $statement->fetch();

        if (empty($user)) {
            throw new AuthenticationException('User with such email not found');
        }

        if (password_verify($password, $user['password'])) {
            $this->session->setData('user', [
                'user_id' => $user['user_id'],
                'firstname' => $user['first_name'],
                'email' => $user['email']
            ]);
            return true;
        }

        throw new AuthenticationException('Incorrect email or password');
    }


}