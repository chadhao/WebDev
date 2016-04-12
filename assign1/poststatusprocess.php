<?php
require_once 'DB.class.php';
require_once 'Post.class.php';

DB::init();

$notice = '';
$notice .= Post::validate_status_code( $_POST['status_code'] );
$notice .= Post::validate_status( $_POST['status'] );

if(!isset($_SESSION)) session_start();

if ( ! empty( $notice ) ) {
    $_SESSION['notice_type'] = 'warning';
    $_SESSION['notice_msg'] = $notice;
    DB::closeDB();
    header( "Location: http://".($_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."/poststatusform.php" );
    exit();
}

$content = Post::prepare_data( $_POST );
if ( DB::insert( 'status', $content ) ) {
    $_SESSION['notice_type'] = 'success';
    $_SESSION['notice_msg'] = 'Your status has been added to database successfully!';
    DB::closeDB();
    header( "Location: http://".($_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."/poststatusform.php" );
    exit();
} else {
    $_SESSION['notice_type'] = 'warning';
    $_SESSION['notice_msg'] = 'Failed adding status to database!';
    DB::closeDB();
    header( "Location: http://".($_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."/poststatusform.php" );
    exit();
}