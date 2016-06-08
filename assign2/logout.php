<?php

foreach ($_COOKIE as $key => $value) {
    if (strpos($key, 'wd_') === false) {
        continue;
    }
    setcookie($key, '', time() - 3600);
}
header('Location: index.php');
exit();
