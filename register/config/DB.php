<?php

class DB
{

    const USER = "root";
    const PASS = '';
    const HOST = "localhost";
    const DB = "usersRegister";

    public static function connToDB(): PDO
    {

        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db = self::DB;

        return new PDO("mysql:dbname=$db;host=$host", $user, $pass);

    }
}
