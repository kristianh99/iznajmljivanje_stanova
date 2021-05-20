<?php
session_start();
require_once 'config.php';
require_once 'db_config.php';
require_once 'functions_def.php';
if (!isset($_SESSION['username']) OR !isset($_SESSION['id_user']) OR !is_int($_SESSION['id_user'])) {
    redirection('index.php?l=0');
}

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

    <title>Web company</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="images/logo.jpg" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Our services</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Profile
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Change profile</a>
                    <a class="dropdown-item" href="#">My works</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Log out</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 p-2">
            <h1 class="display-4">Welcome <?php echo $_SESSION['username'] ?></h1>
            <p class="text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis convallis augue vitae quam feugiat
                viverra. Nulla at diam at est luctus molestie. Nulla leo orci, feugiat ut ex id, placerat ultricies
                dolor. Ut ac enim vel est sodales egestas eu sed lectus. Mauris sed ligula eu arcu elementum ultricies.
                Morbi mi quam, egestas quis pretium at, sodales elementum risus. Lorem ipsum dolor sit amet, consectetur
                adipiscing elit. Nulla tincidunt non ipsum et varius. Suspendisse feugiat justo eu risus ultricies
                commodo. Donec eleifend mauris at lorem elementum gravida. Curabitur ut accumsan purus, lacinia
                vulputate urna. Proin finibus tristique gravida. Nullam tempus convallis orci, nec congue turpis
                faucibus vel. Nam id lacinia nulla, a gravida nulla. Ut blandit erat nisi, in tempor tellus semper
                vitae. Nullam nec euismod purus, lacinia tincidunt ligula.
            </p>
            <p class="text-justify">
                Phasellus elementum, neque nec aliquet elementum, augue est sodales tortor, sed pellentesque turpis
                tortor sed lacus. Nullam accumsan viverra commodo. Phasellus mattis arcu nec ipsum laoreet ornare.
                Vestibulum finibus suscipit mauris, eget tempor leo euismod eget. Nulla facilisi. Suspendisse lacinia
                condimentum viverra. Nunc risus ex, sodales at justo quis, ultricies ornare ex. Lorem ipsum dolor sit
                amet, consectetur adipiscing elit. In hac habitasse platea dictumst. Vivamus varius id ex nec interdum.
                Donec semper porta euismod.
            </p>
            <p class="text-justify">
                Suspendisse sollicitudin posuere feugiat. Praesent at elit sit amet lacus finibus accumsan eu ac ligula.
                Pellentesque a fermentum orci. Sed pretium accumsan dolor, sed placerat lacus efficitur eu. In hac
                habitasse platea dictumst. Aliquam scelerisque urna vitae lobortis mollis. Vivamus dignissim arcu eu
                odio laoreet lacinia. Sed volutpat commodo orci, non ultrices sem porttitor sed. In a mauris a elit
                porta laoreet. Pellentesque dolor turpis, dignissim vitae orci nec, convallis porttitor risus.
            </p>

        </div>
        <div class="col-12 col-md-6 p-2 text-center ">
            <img src="images/christopher-gower-m_HRfLhgABo-unsplash.jpg" alt="Web development" class="img-thumbnail">
            Photo by <a
                    href="https://unsplash.com/@cgower?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Christopher
                Gower</a> on <a
                    href="https://unsplash.com/s/photos/web-development?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a><br>
            <a href="http://www.freepik.com">Logo designed by sentavio / Freepik</a>
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
</body>
</html>