<?php

require_once 'class.DB.php';

DB::init();

$data['email'] = $_POST['email'];
$data['password'] = md5($_POST['psw']);
$data['is_admin'] = 0;

$checkEmail = DB::select('user', 'id', "email='".$data['email']."'");
if (!empty($checkEmail)) {
    echo '0';
} else {
    if (DB::insert('user', $data)) {
        setcookie('wd_is_loggedin', '1', time() + 3600);
        setcookie('wd_user', DB::select('user', 'id', "email='".$data['email']."'")[0]['id'], time() + 3600);
        setcookie('wd_email', $data['email'], time() + 3600);
        echo '2';
    } else {
        echo '1';
    }
}

DB::closeDB();
