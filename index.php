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
            <li><a href="postavi_oglas.php">Postavi oglas</a></li>

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
<div class="row justify-content-center">
    <h1 class="text-center display-1" >IZNAJMI KUĆU\STAN</h1>
</div>
<form action="web.php" method="post">
    <div class="form-group">
        <div class="container">
            <div class="text-center">
                <label for="city">Odaberi grad:</label>
                <select id="city">
                    <option value="0">Subotica</option>
                    <option value="1">Beograd</option>
                    <option value="2">Novi Sad</option>
                </select>

                <label for="apartment">Stan ili kuća:</label>
                <select id="apartment">
                    <option value="0">Stan</option>
                    <option value="1">Kuća</option>
                </select>
                <br><br>

                <div class="col-4">
                    <div class="input-group mb-3">
                        <label for="area"></label>
                        <input id="area" type="number" class="form-control" name="Povrsina" placeholder="Povrsina od" >
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon1">m<sup>2</sup></span>
                        </div>
                    </div><br>
                </div>
                <div class="col-4">
                    <div class="input-group mb-3">
                        <label for="price"></label>
                        <input id="price" name="Cena" class="form-control" type="number" placeholder="Cena do">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">&euro;</span>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <label for="location"></label>
                    <input id="location" name="location" class="form-control" type="text" placeholder="Lokacija">
                </div>
            </div>
        </div>
    </div>
</form>
<div class="search">
    <div class="col-md-12 text-center">
        <button class="btn btn-primary btn-lg">Pretraga</button>
    </div>
</div>
</body>
</html>
