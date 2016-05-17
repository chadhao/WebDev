<?php

class Order
{
    public static function generateRef($email)
    {
        $str1 = date('Ymd');
        $utimestamp = microtime(true);
        $timestamp = floor($utimestamp);
        $str2 = $email.date('His').'.'.round(($utimestamp - $timestamp) * 1000000);

        return sprintf('%X-%X', crc32($str1), crc32($str2));
    }
}
