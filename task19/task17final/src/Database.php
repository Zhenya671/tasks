<?php

namespace App;

use http\Exception\InvalidArgumentException;
use PDO;
use PDOException;

/**
 * class Database contains implementation
 * of connecting with database
 */
class Database
{
    /**
     * @var PDO $connection contain data for connecting with db
     */
    private PDO $connection;

    /**
     * getting data for connection with database
     *
     *contain dsn, username and password for connect with db
     *
     * @param string $dsn
     * @param string $username
     * @param string $password
     */
    public function __construct(string $dsn, string $username = '', string $password = '')
    {
        try {
            $this->connection = new PDO($dsn, $username, $password);
        } catch (PDOException $exception) {
            throw new InvalidArgumentException('Database error: ' . $exception->getMessage());
        }

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    }

    /**
     * connection to db
     *
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }

}