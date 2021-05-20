<?php
session_start();
require_once 'register/config.php';
require_once 'register/db_config.php';
require_once 'register/functions_def.php';
if (!isset($_SESSION['username']) OR !isset($_SESSION['id_user']) OR !is_int($_SESSION['id_user'])) {
    //redirection('index.php?l=0');
    $loggedin=false;
}else{
    $loggedin=true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iznajmljivanje-kuca-stanova</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar " >
    <div class="main">

        <ul>
            <li><a href="#">Početna</a></li>
            <li><a href="o_nama.php">O nama</a></li>
            <li><a href="kontakt.php">Kontakt</a></li>
            <li><a href="#">Postavi oglas</a></li>

            <?php
            if($loggedin){
                echo "<li><a href='register/logout.php'>Odjavi se</a></li>";
            }else{
                echo "<li><a href='register/index.php'>Prijavi se</a>";
            }
            ?>

        </ul>
    </div >
</nav>
<div class="row">
    <div class="loggedin">
        <?php
        if($loggedin){
            echo "Prijavljen kao ".$_SESSION['username'];
        }
        ?>
    </div>
</div>

</body>
</html>
