<?php

class Order
{
    public static function generateRef($email)
    {
        $utimestamp = microtime(true);
        $timestamp = floor($utimestamp);
        $str = $email.date('His').'.'.round(($utimestamp - $timestamp) * 1000000);

        return sprintf('%s %X', date('Ymd'), crc32($str));
    }
}
