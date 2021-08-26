<?php
require_once '../register/functions_def.php';
require_once "../mvc/view.php";
require_once "../components/usersads.php";

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

<section>

    <div class="container p-0 mb-2" style='margin-top:30px; '>
                <?php
                $view = new View();
                $data = $view->getUserData();
                for ($i = 0;$i < sizeof($data);$i++)
                {
                    $value = $data[$i];
                    echo "
                    <div class='d-flex gap-5 flex-wrap'>
                    <div class='left' style='border:2px solid #34495e; padding:15px; width:350px; margin:10px; float:left;'>
                        <form action='#' >
                            <div class='text-center fs-6' style='border-bottom:1px solid #34495e; padding-bottom:3px'>
                                <img src='../img/user.png' style='height:60px;width:60px'/>
                            </div>
                            <div class='form-group mt-3'>
                                <label for='firstname'><b>Ime</b></label>
                                <input type='text' name='firstname' class='form-control' value='$value[firstname]'>
                            </div>
                            <div class='form-group mt-3'>
                                <label for='lastname'><b>Prezime</b></label>
                                <input type='text' name='lastname' class='form-control' value='$value[lastname]'>
                            </div>
                            <div class='form-group mt-3'>
                                <label for='phone'><b>Mobil</b></label>
                                <input type='text' name='phone' class='form-control' value='$value[phone]'>
                            </div>
                            <button onclick='Update(this, \"user\")' class='btn btn-secondary mt-3' type='button'>Sačuvaj</button>
                            <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                <span class='message'></span>
                                <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                </button>
                            </div>
                        </form>
                        </div>
                        <div class='right' style='border:2px solid #34495e; padding:15px; width:700px;margin:10px; float:left; height:435px;'>
                        <form action='#' >
                            <div class='' fs-6' style='border-bottom:1px solid #34495e;'>
                            <img src='../img/pass.png' style='height:60px;width:60px; padding-bottom:3px;'/>
                            <b style='text-transform: uppercase; color:#34495e;'>Nova lozinka</b>
                            </div>
                            <div class='form-group mt-3'>
                                <label for='password'><b>Lozinka</b></label>
                                <input type='password' name='password' class='form-control'>
                            </div>                
                            <div class='form-group mt-3'>
                                <label for='cpassword'><b>Lozinka opet</b></label>
                                <input type='password' name='cpassword' class='form-control'>
                            </div>
                            <div>
                                <button onclick='Update(this, \"user\")' class='btn btn-secondary mt-3' type='button'>Sačuvaj</button>
                                <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                    <span class='message'></span>
                                    <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                    </button>
                                </div>
                            <div>
                        </form>  
                        </div>
                    </div>
                    ";
                }
                ?>
    </div>
</section>
        <section>
            <div class="container p-0 mb-2" style='margin-top:50px;'>
                        <h4><b style="text-transform: uppercase; color:#34495e; margin-left:60px">Moji oglasi</b></h4>
                        <hr style="margin-left: 60px;">
                    <div class="ads-list container" style="margin: 16px 0;">
                        <?php renderUserAds($view, false); ?>
                    </div>

            </div> 
        </section>
    </div>
 <?php include("../components/footer.php") ?> 
</body>
    
</html>