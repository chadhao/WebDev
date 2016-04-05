<?php
require_once 'DB.class.php';
require_once 'Post.class.php';

DB::init();

//echo '<script type="text/javascript">alert("'.DB::DB_HOST.'");</script>';

$notice = Post::validate_status_code($_POST['status_code']);

if ( ! empty( $notice ) ) {
    setcookie('notice_msg', $notice);
    header("Location: poststatusform.php");
    exit();
}