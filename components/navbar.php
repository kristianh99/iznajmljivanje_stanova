<?php 
$root = 'https://'.getenv('HTTP_HOST');

if(strpos($_SERVER['PHP_SELF'],basename(__FILE__))){
    header("Location:$root");
}
$admin = false;
if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 1){
    $admin = true;
}

if(isset($_SESSION['id_user']))
{
   echo '<script> sessionStorage.setItem("id", "' .$_SESSION['id_user'] .'");</script>';
}

?>

<section id="header">
<div class="menu-bar">
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="brand" href="<?php echo $root.'/home'; ?>">
            <p>HR</p>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav" style="background-color: #34495e; z-index:10;">
            <ul class="navbar-nav flex-fill justify-content-end align-items-center">
                <li class="nav-item">
                    <a href="<?php echo $root.'/home'; ?>" class="nav-link">Početna</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $root.'/'; ?>"class="nav-link">Nekretnine</a>
                </li>
                <?php
                    if($loggedIn){
                        $profilePage= "$root/profile/"; 
                        $chatPage= "$root/chat/"; 
                        echo "
                        <li class='nav-item'>
                            <a href='$profilePage'class='nav-link'>Profil</a>
                        </li>
                        <li class='nav-item'>
                            <a href='$chatPage'class='nav-link notification'>Poruke</a>
                        </li>
                        ";
                    }
                    if($admin){
                        $adminPage= "$root/admin/"; 
                        echo "
                        <li class='nav-item'>
                            <a href='$adminPage'class='nav-link'>Admin</a>
                        </li>
                        ";
                    }
                ?>
                <li class="nav-item">
                    <?php
                        if($loggedIn){
                            $adminPage= "$root/register/logout.php"; 
                            echo "
                            <a href='$adminPage' class='nav-link'>Izloguj se</a>
                            ";
                        }else{
                            $registerPage= "$root/register/"; 
                            echo "
                            <a href='$registerPage' class='nav-link'>Prijava / Registracija</a>
                            ";
                        }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
</div>
</section>