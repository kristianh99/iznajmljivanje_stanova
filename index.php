<?php
session_start();
require "./mvc/view.php";

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

    <?php include("./components/head.php") ?>

    <body class="app">
    <div class="content">

    <section>
        <?php include("./components/navbar.php") ?>
    </section>


        <section id="hero">
            <div class="hero-container text-center">

                <div class="actions">
                    <form class="filters-wrapper">
                        <div class="filters">
                            <label class="form-label" style="text-transform:uppercase; ;">Tip nekretnine</label>
                            <select class="form-select" onchange="GetEntry(this, 'ads')" name="type">
                                <option value="">Tip</option>
                                    <?php
                                        $filters = $ads->getFilters();
                                        $property_type = [];
                                        for ($i=0; $i < sizeof($filters['property_type']); $i++) { 
                                            $value = $filters['property_type'][$i];
                                            $property_type[] = $value;
                                            echo "<option value='$value[id]'>$value[property_type]</option>";
                                        }
                                    ?>
                            </select>
                        </div> 
                        <div class="filters">
                            <label class="form-label">Mesto</label>
                            <select class="form-select" onchange="GetEntry(this, 'ads')" name="location">
                                <option value="">Mesto</option>
                            <?php
                            
                            for ($i=0; $i < sizeof($filters['location']); $i++) { 
                                $value = $filters['location'][$i];
                                echo "<option value='$value[location]'>$value[location]</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <div class="filters">
                            <label class="form-label">Cena</label>
                            <?php
                                $range = $filters['minmax'][0];
                                echo "<input onchange=\"GetEntry(this, 'ads')\" type='range' class='form-range' min='$range[min]' max='$range[max]' name='range'>";
                            ?>
                        </div>
                        <div class="filters">
                            <label class="form-label">Početak iznajmljivanja</label>
                            <?php
                                echo "<input class='form-control' onchange=\"GetEntry(this, 'ads')\" type='date' class='form-range' name='rent_start'>";
                            ?>
                        </div>
                        <div class="filters">
                            <label class="form-label">Kraj iznajmljivanja</label>
                            <?php
                                echo "<input class='form-control' onchange=\"GetEntry(this, 'ads')\" type='date' class='form-range' name='rent_end'>";
                            ?>
                            <br>
                            <hr>
                        </div>
                        <?php 
                            if(isset($_SESSION['id_user'])){
                                echo "
                                <div class='section-title'>
                                    <button type='button' class='btn' data-toggle='modal' data-target='#newad' style='float:right;text-transform:uppercase; color:#34495e; border:1px solid #34495e;' onclick=\"AddNewAd("; echo htmlspecialchars(json_encode($property_type)); echo")\">Dodalj novi</button>
                                </div><br>
                                ";
                            }
                            ?>
                    </form>
                </div>

                <div class="ads-list">

                    <?php
                        $adsData = $ads->getAds();
                        for ($i = 0;$i < sizeof($adsData);$i++)
                        {
                            $value = $adsData[$i];
                            if($value['active'] != 0){
                                echo "
                                    <button type='button'  data-toggle='modal' data-target='#ad-$i' style='border: none; border-radius: 10px; width:250px; height:290px; margin-left:50px; background:transparent;'>
                                        <img src='uploads/$value[image]' height='250px' width='250px' style='border-top-right-radius: 10px; border-top-left-radius: 10px'>
                                        <p style='margin: 8px;'>Informacije</p>
                                    </button>
                        
                                    <div class='modal fade' id='ad-$i' tabindex='-1' role='dialog' aria-labelledby='ad-$i' aria-hidden='true'>
                                        <div class='modal-dialog' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='exampleModalLongTitle'>$value[property_type]</h5>
                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>
                                                <div class='modal-body'>
                                                    <p class='card-text'><b>Cena: </b>$value[price] € / dan</p>
                                                    <p class='card-text'> <b>Lokacija: </b>$value[location]</p>

                                                    <div>
                                                        <div class='field-single'>
                                                            <label>Početak iznajmljivanja</label>
                                                            <input type='date' disabled value='$value[rent_start]'/>
                                                        </div>
                                                        <div class='field-single'>
                                                            <label>Kraj iznajmljivanja</label>
                                                            <input type='date' disabled value='$value[rent_end]'/>
                                                        </div>
                                                    </div>

                                                    <p class='card-text' style='margin-top:10px;font-size: 15px;'>$value[description]</p>
                                                    <p class='card-text'><small class='text-muted'>$value[email]</small></p>
                                                </div>
                                                ";
                                                if(isset($_SESSION['id_user'])){
                                                    if($value['rented_by'] != null){
                                                        echo "<div class='rented'>Već izdato</div>";
                                                    }
                                                    if($value['rented_by'] == $_SESSION['id_user']){
                                                        echo "
                                                        <div  style='background-color:transparent;'>
                                                            <form>
                                                                <label style='margin-top:5px; padding-left:20px;'>Komment kod:</label>
                                                                <input class='form-control' style='margin-bottom:5px;' name='verification'/>
                                                                <h5 style='text-align: center;'>Komment</h5>
                                                                <div class='card-footer' style='background-color:transparent;'>
                                                                    <textarea type='text' class='area form-control'></textarea>
                                                                    <button type='button' class='btn' onclick=\"sendComment(this, $value[id])\">Pošalji</button>
                                                                    <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                                                        <span class='message'></span>
                                                                        <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        ";
                                                    }else if($value['id_user'] != $_SESSION['id_user']){
                                                        echo "
                                                        <div class='card-footer' style='background-color:transparent;'>
                                                            <h5 style='text-align: center;'>Pošalji poruku</h5>
                                                            <textarea type='text' class='area form-control'></textarea>
                                                            <button type='button' class='btn' onclick=\"sendMessage(this, $value[id_user])\">Pošalji</button>
                                                            <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                                                <span class='message'></span>
                                                                <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                                                </button>
                                                            </div>
                                                        </div>";
                                                    } else{
                                                        $users = $ads->users();
                                                        echo "
                                                            <div class='btn' onclick=\"DeleteAd(this, $value[id])\">Izbiši oglasi</div>
                                                            <form>
                                                                <select class='form-control' style='display:block;' name='rented_by'>
                                                                    <option disabled selected>Korisnik</option>
                                                                        ";
                                                                        for ($i=0; $i < sizeof($users); $i++) { 
                                                                            $userValue = $users[$i];
                                                                            echo "
                                                                            <option value='$userValue[id_user]' ".($userValue['id_user'] == $value['rented_by'] ? "selected='true'" : "").">$userValue[email]</option>
                                                                            ";
                                                                        }
                                                                        echo "
                                                                </select>
                                                                <div class='btn' onclick=\"ReservateAd(this, $value[id])\">Izdaj korisniku</div>
                                                                <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                                                    <span class='message'></span>
                                                                    <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        ";
                                                    }
                                                }
                                                echo "
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Zatvori</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                ";
                            }
                            
                        }
                        
                        if(!sizeof($adsData)){
                            echo "
                                <div class='row'>
                                    There is no active ad. 
                                </div>
                            ";             
                        }

                    ?>
                </div>
            </div>
        </section>
    </div>
    <?php include("./components/footer.php") ?>

    </body>
</html>