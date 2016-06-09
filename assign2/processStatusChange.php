<?php

require_once 'class.DB.php';

DB::init();
$ref = $_POST['ref'];
$result = DB::update('caborder', "status='assigned'", "ref='".$ref."'");
if (!$result) {
    echo '0';
} else {
    echo '1';
}

DB::closeDB();
