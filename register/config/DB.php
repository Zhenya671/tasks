<?php

class DB
{

    const USER = "root";
    const PASS = '47819812';
    const HOST = "localhost";
    const DB = "evgeni";

    public static function connToDB(): PDO
    {

        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db = self::DB;

        return new PDO("mysql:dbname=$db;host=$host", $user, $pass);

    }
}
