<?php

namespace App;

use DateTime;

/**
 * class Logger implement writing logs in each file logger.log
 */
class Logger
{
    private static string $formatData = 'd.m.Y G:i:s';

    /**
     * implements writing logs about upload file
     *
     * @param mixed|null $error error about uploading file
     * @param array $file file properties
     * @param string $type shows which action was executed (upload)
     * @return void
     */
    public static function file($error, array $file, string $type)
    {

        if (empty($error)) {
            $status = 'Successful';
        } else {
            $status = "Not successful($error)";
        }

        $timeToLoad = new DateTime("now");
        $content = "$type Date: {$timeToLoad->format(self::$formatData)}   Name: {$file['filename']}   Size: {$file['filesize']}   status: $status";
        file_put_contents('logger.log', $content . PHP_EOL, FILE_APPEND);

    }

    /**
     * @param string $error error about attempt login or register
     * @param string $type shows which action was executed (login/register)
     * @return void
     */
    public static function attempt(string $error, string $type)
    {

        if (empty($error)) {
            $status = 'Successful';
        } else {
            $status = "Not successful($error)";

        }
        $timeAttempt = new DateTime("now");
        $description = "$type Date: {$timeAttempt->format(self::$formatData)} status: {$status}";
        file_put_contents('logger.log', $description . PHP_EOL, FILE_APPEND);


    }

    public static function failedAttempt($count,$email)
    {

        $ip = $_SERVER['REMOTE_ADDR'];

        $timeStartBlock = new DateTime("now");
        $timeEndBlock = new DateTime("now +15min");

        $description = "startBlock: {$timeStartBlock->format(self::$formatData)} endBlock: {$timeEndBlock->format('d.m.Y G:i:s')} countFailedAttempts: {$count} ip: {$ip} email: {$email}";
        file_put_contents('failedAttempt.log', $description . PHP_EOL, FILE_APPEND);

    }
}