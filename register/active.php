<?php

require "config.php";
require "db_config.php";
require "functions_def.php";

$code = "";

if (isset($_GET['code'])){
    $code = mysqli_real_escape_string($connection, trim($_GET['code']));
}
    
if (!empty($code) AND strlen($code) === 40) {
    $sql = "UPDATE users SET active='1', code='', registration_expires=''
            WHERE  binary code = '$code' AND registration_expires>now()";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_affected_rows($connection) > 0) {
       redirection('index.php?r=6');
    }
    else {
        redirection('index.php?r=11');
    }
}
else {
    redirection('index.php?r=0');
}