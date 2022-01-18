<?php

namespace App;

/**
 * class Session the implement work with session
 *  method that start session, set data, get data, and unset session data
 */
class Session
{


    /**
     * method that start session
     *
     * @return void
     */
    public function start(): void
    {
        session_start();
    }

    /**
     * setting data in session
     *
     * @param string $key name of data which stored in session
     * @param $value
     */
    public function setData(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * getting data from session
     *
     * @param string $key name of data which stored in session
     * @return mixed|null
     */
    public function getData(string $key)
    {
        if (!empty($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
          return null;
    }

    /**
     * Write session data and end session
     *
     * @return void
     */
    public function save(): void
    {
        session_write_close();
    }

    /**
     * getting data from session by key and unset session data by ket
     *
     * @param string $key name of data which stored in session
     * @return mixed|null
     */
    public function flush(string $key)
    {
        $value = $this->getData($key);
        $this->unset($key);

        return $value;
    }

    /**
     * unset session data by ket
     *
     * @param string $key name of data which stored in session
     */
    private function unset(string $key): void
    {
        unset($_SESSION[$key]);
    }
}