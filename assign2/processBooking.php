<?php

require_once 'class.DB.php';

function generateRef($email)
{
    $utimestamp = microtime(true);
    $timestamp = floor($utimestamp);
    $str = $email.date('His').'.'.round(($utimestamp - $timestamp) * 1000000);

    return sprintf('%X', crc32($str));
}

DB::init();

$data['ref'] = generateRef($_POST['email']);
$data['user'] = intval($_POST['user']);
if (!empty($_POST['p_unitno'])) {
    $data['pick_up_unit_no'] = intval($_POST['p_unitno']);
}
$data['pick_up_street_no'] = intval($_POST['p_streetno']);
$data['pick_up_street_name'] = $_POST['p_streetname'];
$data['pick_up_suburb'] = $_POST['p_suburb'];
$data['pick_up_time'] = date_create_from_format('d-m-Y H:i', $_POST['p_time'])->format('Y-m-d H:i:s');
$data['destination_suburb'] = $_POST['d_suburb'];
$data['order_time'] = date('Y-m-d H:i:s');
$data['status'] = 'unassigned';

if (DB::insert('caborder', $data)) {
    echo $data['ref'];
} else {
    echo '0';
}

DB::closeDB();
