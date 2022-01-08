<?php

class DB
{

    const USER = "zhenya";
    const PASS = 'root';
    const HOST = "localhost";
    const DB = "users";

    public static function connToDB(): PDO
    {

        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db = self::DB;

        return new PDO("mysql:dbname=$db;host=$host", $user, $pass);

    }
}