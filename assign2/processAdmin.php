<?php

require_once 'class.DB.php';

DB::init();

$time = empty($_POST['time']) ? 0 : (new DateTime())->setTimestamp(time() + intval($_POST['time']));
if (!empty($time)) {
    $time->setTimeZone(new DateTimeZone('Pacific/Auckland'));
}
$ctime = new DateTime();
$ctime->setTimeZone(new DateTimeZone('Pacific/Auckland'));
$status = $_POST['status'];
$orderby = $_POST['orderby'];
$result = DB::select('caborder',
  '*',
  (empty($time) ? (empty($status) ? '' : ("status = '".$status."'")) : (empty($status) ? ("pick_up_time < '".$time->format('Y-m-d H:i:s')."' AND pick_up_time > '".$ctime->format('Y-m-d H:i:s')."'") : ("pick_up_time < '".$time->format('Y-m-d H:i:s')."' AND pick_up_time > '".$ctime->format('Y-m-d H:i:s')."' AND status = '".$status."'"))),
  $orderby.' DESC');

for ($i = 0; $i < count($result); ++$i) {
    $user = DB::select('user', 'name, phone', 'id = '.$result[$i]['user']);
    $result[$i]['name'] = $user[0]['name'];
    $result[$i]['phone'] = $user[0]['phone'];
}

if ($result) {
    echo json_encode($result);
} elseif (is_array($result) && count($result) == 0) {
    echo '1';
} else {
    echo '0';
}

DB::closeDB();
