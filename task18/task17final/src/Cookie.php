<?php

namespace App;

/**
 * class Cookie contains implementation of creating
 * and checking cookies
 */
class Cookie
{
    const HOUR = 60 * 60;
    const WEEK = 60 * 60 * 24 * 7;

    /**
     * create new cookie
     *
     * @param array $authentication string contains value of login form
     * @return void
     */
    public static function create(array $authentication): void
    {

        if ($authentication['checkbox'] !== false){
            setcookie("email", $authentication['email'], time() + self::WEEK, '/');
        }else {
            setcookie("email", $authentication['email'], time() + self::HOUR, '/');
        }

    }

    /**
     * getting data about existing cookie or return null
     *
     * @param $key string contains value of cookie
     * @return mixed|null
     */
    public static function getData(string $key)
    {
        if (self::existCookie($key)) {
            return $_COOKIE[$key];
        }
        return null;
    }

    public static function createForBlocUser($authentication) {

        setcookie("block-user", $authentication['email'], time() + 60 *15, '/');

    }

    /**
     * checking exist cookie
     *
     * @param $key string contains value of cookie
     * @return bool
     */
    public static function existCookie(string $key): bool
    {

        if (isset($_COOKIE[$key])) {
            return true;
        }

        return false;
    }

    /**
     * destroying cookie that's already set
     *
     * @return void
     */
    public static function destroy()
    {
        setcookie("email", '', time(), '/');
        setcookie("block-user", '', time(), '/');
    }

}