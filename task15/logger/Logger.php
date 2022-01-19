<?php

class Logger
{
    public static function file($error, $file)
    {
        $requestError = '';
        foreach ($error as $value) {
            $requestError = $value;
        }

        if (empty($error)){
            $status = 'Successful';
        } else {
            $status = "Not successful($requestError)";
        }

        $timeToLoad = new DateTime("now");
        $content = "Date: {$timeToLoad->format('d.m.Y G:i:s')}   Name: {$file['name']}   Size: {$file['size']}   status: $status";
        file_put_contents('logger.log', $content . PHP_EOL, FILE_APPEND);

    }
}
