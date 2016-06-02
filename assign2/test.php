<?php
session_start();
if ($_GET['cs'] == 1) {
    $_SESSION = array();
    session_destroy();
}
echo var_dump($_SESSION);