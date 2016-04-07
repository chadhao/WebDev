<?php
require_once 'DB.class.php';
require_once 'Post.class.php';

DB::init();

$notice = '';
$notice .= Post::validate_status_code( $_POST['status_code'] );
$notice .= Post::validate_status( $_POST['status'] );

if ( ! empty( $notice ) ) {
    setcookie( 'notice_type', 'warning' );
    setcookie( 'notice_msg', $notice );
    header( "Location: http://".($_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."/poststatusform.php" );
    exit();
}

$content = Post::prepare_data( $_POST );
if ( DB::insert( 'status', $content ) ) {
    setcookie( 'notice_type', 'success' );
    setcookie( 'notice_msg', 'Your status has been added to database successfully!' );
    header( "Location: http://".($_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."/poststatusform.php" );
    exit();
} else {
    setcookie( 'notice_type', 'warning' );
    setcookie( 'notice_msg', 'Failed adding status to database!' );
    header( "Location: http://".($_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']))."/poststatusform.php" );
    exit();
}