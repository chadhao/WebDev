<?php

require_once 'class.DB.php';

DB::init();

$time = empty($_POST['time']) ? 0 : (new DateTime())->setTimestamp(time() + intval($_POST['time']));
if (!empty($time)) {
    $time->setTimeZone(new DateTimeZone('Pacific/Auckland'));
}
$status = $_POST['status'];
$orderby = $_POST['orderby'];
$result = DB::select('caborder',
  '*',
  (empty($time) ? (empty($status) ? '' : ("status = '".$status."'")) : (empty($status) ? ("pick_up_time < '".$time->format('Y-m-d H:i:s')."'") : ("pick_up_time < '".$time->format('Y-m-d H:i:s')."' AND status = '".$status."'"))),
  $orderby.' DESC');

if ($result) {
    echo json_encode($result);
} else {
    echo '0';
}

DB::closeDB();
