<?php

require_once 'class.DB.php';

DB::init();

$data['email'] = $_POST['email'];
$data['password'] = md5($_POST['psw']);

$emailExist = DB::select('user', 'id, password, is_admin', "email='".$data['email']."'");
if (!empty($emailExist)) {
    if (strcasecmp($data['password'], $emailExist[0]['password']) == 0) {
        setcookie('wd_is_loggedin', '1', time() + 3600);
        setcookie('wd_user', $emailExist[0]['id'], time() + 3600);
        setcookie('wd_email', $data['email'], time() + 3600);
        if ($emailExist[0]['is_admin']) {
            setcookie('wd_is_admin', '1', time() + 3600);
        }
        echo '2';
    } else {
        echo '1';
    }
} else {
    echo '0';
}

DB::closeDB();
