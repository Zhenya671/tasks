<?php

class Model
{
    protected ?PDO $db = null;

    public function __construct()
    {
        $this->db = DB::connToDB();
    }
}