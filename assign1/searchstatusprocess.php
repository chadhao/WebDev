<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'DB.class.php';
require_once 'Post.class.php';

DB::init();

$notice = Post::validate_keyword($_GET['search']);

if (!isset($_SESSION)) {
    session_start();
}

if (!empty($notice)) {
    $_SESSION['notice_type_search'] = 'warning';
    $_SESSION['notice_msg_search'] = $notice;
    DB::closeDB();
    header('Location: http://'.($_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])).'/searchstatusform.php');
    exit();
}

$_SESSION['search_keyword'] = $_GET['search'];
$result = Post::get_status($_GET['search']);

if (empty($result)) {
    $_SESSION['search_result_empty'] = 1;
    DB::closeDB();
    header('Location: http://'.($_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])).'/searchstatusform.php');
    exit();
} else {
    $_SESSION['search_result_empty'] = 0;
    $_SESSION['search_result'] = $result;
    DB::closeDB();
    header('Location: http://'.($_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])).'/searchstatusform.php');
    exit();
}
