<?php

require_once 'class.DB.php';

if (!isset($_SESSION)) {
    session_start();
}

DB::init();

$data['email'] = $_POST['email'];
$data['password'] = md5($_POST['psw']);
$data['is_admin'] = 0;

$checkEmail = DB::select('user', 'id', "email='".$data['email']."'");
if (!empty($checkEmail)) {
    echo '0';
} else {
    if (DB::insert('user', $data)) {
        $_SESSION['is_loggedin'] = true;
	$_SESSION['user'] = intval(DB::select('user', 'id', "email='".$data['email']."'")[0]['id']);
        echo '2';
    } else {
        echo '1';
    }
}

DB::closeDB();
