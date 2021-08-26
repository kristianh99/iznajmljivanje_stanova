<?php
require_once '../register/functions_def.php';
require_once "../mvc/view.php";
session_start();
if (!isset($_SESSION['username']) OR !isset($_SESSION['id_user']) OR !is_int($_SESSION['id_user'])) {
    redirection('../index.php');
}
$loggedIn = true;

?>

<!doctype html>
<html lang="en">

    <?php include("../components/head.php") ?>

<body class="app">
<div class="content">

<section>
    <?php include("../components/navbar.php") ?>
</section>

    <div class="container p-0 mb-2" style="margin-top: 50px;">
        <div class="card" style="transform: none; box-shadow:none; border:none;">
            <div class="text-center fs-4 card-header" style="background-color: transparent; border:none;">
                <b style="text-transform: uppercase; color:#34495e;">PORUKE</b>
            </div>
            <div class="card-body">
            <?php

            $view = new View();
            $data = $view->getMessages();
                echo "
                <div class='d-flex gap-5 flex-wrap'>

                    <form action='#' class='chat-left'>
                    ";
                        for ($i=0; $i < sizeof($data); $i++) { 
                            $value = $data[$i];
                            if($value['id_user'] != $_SESSION['id_user']){
                                echo "<div onclick=\"showMessages($value[id_user])\" class='messages-user'><span class='notification-chat'>$value[seen]</span>  $value[email] </div> <hr>";
                            } 
                        }
                    echo "</form>
                    
                    <div class='messagebox' style='width: calc((70%) - 1.5rem);'>
                        <form action='#' class='messages'>
                            <div style='text-align:center;'>Izaberi korisnika</div>
                        </form>
                        <div class='actions'></div>
                    </div>
                </div> 
                ";
            ?>
                </div>
            </div>
        </div>
</div>
    <?php include("../components/footer.php") ?>
    </body>
</html>