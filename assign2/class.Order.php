<?php

class Order
{
    public static function generateRef($email)
    {
        $utimestamp = microtime(true);
        $timestamp = floor($utimestamp);
        $str = $email.date('His').'.'.round(($utimestamp - $timestamp) * 1000000);

        return sprintf('%X', crc32($str));
    }
    
    public static function createOrder() {
	
    }
}
