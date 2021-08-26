<?php
require_once 'config.php';

echo '<script> sessionStorage.removeItem("id");</script>';

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../css/main.css">
          
    <title>Register / login</title>
</head>
<body style="background-image: url(../img/bg.jpg);">
<div class="header">
    <a href="../home/index.php" style="font-size:22px;">NAZAD</a>
</div>

<div class="account_main">
    <div class="form_area">
        <div class="main_con">
            <div class="form_con">

                <div class="text-center">
                    <span id="action">Prijava / Registracija</span>
                </div>        
                <div class="log_form">
                    <h2>PRIJAVA</h2>
                    <br>
                    <hr>
                    <form action="web.php" method="post">
                        <div class="input-box">
                            <input type="email" id="loginUsername" name="username" required placeholder="Email">
                        </div>
                        <div class="input-box">
                            <input type="password" id="loginPassword" name="password" required placeholder="Lozinka">
                        </div>
                        <div class="button">
                            <input type="hidden" name="action" value="login">
                            <button type="submit">Prijava</button>
                        </div>
                    </form>
                    <br>
                    <a href="#" id="fl" style="color: black;">Zaboravili ste lozinku?</a>
                    <form action="web.php" method="post" name="forget" id="forget" style="display:none; margin-top:5px;">
                        <div class="form-group">
                            <input type="email" class="form-control" id="forgetEmail" placeholder="Unesi email adresu"
                                name="email">
                        </div>
                        <input type="hidden" name="action" value="forget">
                        <button type="submit" class="btn btn-secondary">Pošalji</button>
                    </form>
                    <?php

                    $l = 0;

                    if (isset($_GET["l"]) and is_numeric($_GET['l'])) {
                        $l = (int)$_GET["l"];

                        if (array_key_exists($l, $messages)) {
                            echo '
                            <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                                '.$messages[$l].'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            ';
                        }
                    }
                    ?>
                </div>

                <!--register-->
                <div class="reg_form hidden">
                    <h2>REGISTRACIJA</h2>
                    <br>
                    <hr>
                    <form action="web.php" method="post">
                        <div class="input-box">
                            <input type="text" id="registerFirstname" name="firstname" required placeholder="Ime">
                        </div>
                        <div class="input-box">
                            <input type="text" id="registerLastname" name="lastname" required placeholder="Prezime">
                        </div>
                        <div class="input-box">
                            <input type="email" id="registerEmail" name="email" required placeholder="Email">
                        </div>
                        <div class="input-box">
                            <input type="text" id="registerPhone" name="phone" required placeholder="Mobil">
                        </div>
                        <div class="input-box">
                            <input type="password" id="registerPassword" name="password" required placeholder="Password">
                        </div>
                        <div class="button">
                            <input type="hidden" name="action" value="register">
                            <button type="submit">Registracija</button>
                        </div>
                    </form>
                        
                    <?php
                    $r = 0;

                    if (isset($_GET["r"]) and is_numeric($_GET['r'])) {
                        $r = (int)$_GET["r"];

                        if (array_key_exists($r, $messages)) {
                            echo '
                            <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                                '.$messages[$r].'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            ';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

            <?php
            $r = 0;

            if (isset($_GET["r"]) and is_numeric($_GET['r'])) {
                $r = (int)$_GET["r"];

                if (array_key_exists($r, $messages)) {
                    echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        '.$messages[$r].'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ';
                }
            }
            ?>
        </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $("#action").click(function(){
            $(".log_form, .reg_form").toggle(1200);
        });
    </script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

<script src="js/script.js"></script>
</body>
</html>