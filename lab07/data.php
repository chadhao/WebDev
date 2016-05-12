<?php

require_once 'DB.class.php';

$name = $_POST['name'];
$pwd = $_POST['pwd'];
$msg = '';

if (DB::init()) {
    $result = DB::select('lab07', '*', "name='".$name."'");
    if (!empty($result)) {
        if ($result[0]['password'] == $pwd) {
            $msg = '<p>E-mail: '.$result[0]['email'].'</p>';
        } else {
            $msg = '2';
        }
    } else {
        $msg = '1';
    }
}

echo $msg;
