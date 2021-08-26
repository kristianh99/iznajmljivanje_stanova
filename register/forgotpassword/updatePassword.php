<?php
require_once '../../db.php';
require_once "../functions_def.php";
session_start();

if (
    isset($_POST["password"]) &&
    $_POST["token"]
) {
    $token = $_POST["token"];
    $conn = DB::connect();
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $query = mysqli_query(
        $conn,
        "SELECT * FROM `users` WHERE `code_password` = '$token'"
    );
    $row = mysqli_num_rows($query);
    if ($row) {
        mysqli_query(
            $conn,
            "UPDATE `users` SET `password` = '$password' , `code_password` = NULL , `new_password_expires`=  NULL WHERE `code_password` = '$token'"
        );
        redirection("../index.php?l=12");
    } else {
        redirection("../index.php?l=13");
    }
}
?>
