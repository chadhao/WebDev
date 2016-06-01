<?php

require_once 'class.DB.php';

DB::init();

$data['email'] = $_POST['email'];
$data['password'] = $_POST['psw'];
$data['is_admin'] = false;

$checkEmail = DB::select('user', 'id', 'email='.$data['email']);
if (empty($checkEmail)) {
    echo '0';
} else {
    if (DB::insert('user', $data)) {
        echo '2';
    } else {
        echo '1';
    }
}
