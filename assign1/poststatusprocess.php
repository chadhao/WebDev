<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT'].'/assign1/');

//require_once 'DB.class.php';
require_once DIR_ROOT.'Post.class.php';
//
//DB::init();

//echo '<script type="text/javascript">alert("'.DB::DB_HOST.'");</script>';
//$notice = Post::validate_status_code($_POST['status_code']);

echo '<script type="text/javascript">alert("'.(class_exists('Post')?'yes':'no').'");</script>';
echo '<script type="text/javascript">alert("'.DIR_ROOT.'Post.class.php");</script>';

if ( ! empty( $notice ) ) {
    setcookie('notice_msg', $notice);
    header("Location: http://".($_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."/poststatusform.php");
    exit();
}