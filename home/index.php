<?php
session_start();
require "../mvc/view.php";

$ads = new View();


$admin = false;
$loggedIn = false;

if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 1){
    $admin = true;
}

if (isset($_SESSION['user_type']) &&  $_SESSION['user_type'] >= 1)
{
    $loggedIn = true;
}

?>



<!doctype html>
<html lang="en">

<?php include("../components/head.php") ?>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<!-- <link rel="stylesheet" href="../css/flexslider.css">
<link rel="stylesheet" href="../css/jquery.fancybox.css"> -->
<!-- <link rel="stylesheet" href="../css/main1.css"> -->
<link rel="stylesheet" href="../css/responsive.css">
<link rel="stylesheet" href="../css/font-icon.css">
<link rel="stylesheet" href="../css/animate.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
<body>

<section>
   <?php include("../components/navbar.php") ?>
</section>



    <div id="fullpage">
       <!-- sec-1 -->
        <section>
            <div class="text">
                <h1>WELCOME!</h1>
                <div class="welcome">
                    <span>Find the right accommodation for you!</span>
                </div>
            </div>
        </section>
        
        <!-- sec-3 -->
        <section>
            <div class="wrapper">
                <div class="section">
                    <div class="left-section">
                        <div class="content">
                            <div class="title">
                                <h2><em>ABOUT US</em></h2>
                                <h4><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em></h4>
                            </div>
                            <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                            when an unknown printer took a galley of type and scrambled it to make a type 
                            specimen book. It has survived not only five centuries, but also the leap into 
                            electronic typesetting, remaining essentially unchanged. It was popularised in 
                            the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                            and more recently with desktop publishing software like Aldus PageMaker including 
                            versions of Lorem Ipsum.
                            </p>
                            <div class="contact">
                            <p>CONTACT: <small>nikolastanic95@gmail.com</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="image-section">
                        <img src="../img/profile.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
<script type="text/javascript" >
    $('#fullpage').fullpage();
</script>
</html>