<?php

require_once 'class.DB.php';

DB::init();

$data['email'] = $_POST['email'];
$data['password'] = md5($_POST['psw']);

$emailExist = DB::select('user', 'id, password', "email='".$data['email']."'");
if (!empty($emailExist)) {
    if (strcasecmp($data['email'], $emailExist[0]['password']) == 0) {
        setcookie('wd_is_loggedin', '1', time() + 3600);
        setcookie('wd_user', $emailExist[0]['id'], time() + 3600);
        echo 2;
    } else {
        echo 1;
    }
} else {
    echo 0;
}
