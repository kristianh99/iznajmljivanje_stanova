<?php
require_once 'config.php';

/*

 to do:
 1. JavaScript validation
 2. Forgotten password

 optional to do:

 1. Create script for sending email failures

 infos:
 https://toolheap.com/test-mail-server-tool/
 https://monirulalom.medium.com/test-send-emails-in-php-with-xampp-and-mailhog-ce3e47e1abc2
 http://dev.mysql.com/doc/refman/5.6/en/date-and-time-functions.html

 After installing and setting MailHog, start it in cmd prompt with mailhog

 In web browser type http://localhost:8025/ to use web console for mailhog

 */
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

    <title>Register / login</title>
</head>
<body>
<div class="container">
    <div class="row m-2">
        <div class="col p-3">
            <h1>Register</h1>
            <form action="web.php" method="post">
                <div class="form-group">
                    <label for="registerUsername">Username</label>
                    <input type="text" class="form-control" id="registerUsername"
                           placeholder="Enter username" name="username">
                </div>
                <div class="form-group">
                    <label for="registerFirstname">Firstname</label>
                    <input type="text" class="form-control" id="registerFirstname"
                           placeholder="Enter firstname" name="firstname">
                </div>

                <div class="form-group">
                    <label for="registerLastname">Lastname</label>
                    <input type="text" class="form-control" id="registerLastname"
                           placeholder="Enter lastname" name="lastname">
                </div>

                <div class="form-group">
                    <label for="registerEmail">E-mail address</label>
                    <input type="email" class="form-control" id="registerEmail"
                           placeholder="Enter valid e-mail address" name="email">
                </div>

                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" class="form-control" name="password" id="registerPassword" placeholder="Password (min 8 characters)">
                </div>

                <div class="form-group">
                    <label for="registerPasswordConfirm">Password confirm</label>
                    <input type="password" class="form-control" name="passwordConfirm" id="registerPasswordConfirm" placeholder="Password again">
                </div>

                <input type="hidden" name="action" value="register">
                <button type="submit" class="btn btn-primary">Register</button>
            </form>

            <?php
// index.php?r=1
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

        <div class="col bg-light p-3">
            <h1>Login</h1>
            <form action="web.php" method="post">
                <div class="form-group">
                    <label for="loginUsername">Username</label>
                    <input type="text" class="form-control" id="loginUsername"
                           placeholder="Enter username" name="username">
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" class="form-control" id="loginPassword" placeholder="Password"
                           name="password">
                </div>
                <input type="hidden" name="action" value="login">
                <button type="submit" class="btn btn-primary">Login</button>
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
            <a href="#" id="fl">Forgot your password?</a>
            <form action="web.php" method="post" name="forget" id="forget" style="display:none">
                <div class="form-group">
                    <label for="forgetEmail">E-mail</label>
                    <input type="email" class="form-control" id="forgetEmail" placeholder="Enter your e-mail address"
                           name="email">
                </div>
                <input type="hidden" name="action" value="forget">
                <button type="submit" class="btn btn-primary">Reset password</button>
            </form>

        </div>

    </div>
</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
-->

<script src="js/script.js"></script>
</body>
</html>