<?php
$root = 'https://'.getenv('HTTP_HOST');

if(strpos($_SERVER['PHP_SELF'],basename(__FILE__))){
    header("Location:$root");
}

function renderUserAds($view, $admin = true) {
    
    $adsData = $admin ? $view->getAds() : $view->getMyAds();
    $propertyData = $view->getFilters();
    $comments = $view->getComments();

    for ($i = 0;$i < sizeof($adsData);$i++)
    {
        $value = $adsData[$i];
        echo "
        <button type='button'  data-toggle='modal' data-target='#ad-$i' style='border: none; border-radius: 10px; width:250px; height:290px; margin-left:50px; background:transparent;'>
            <img src='../uploads/$value[image]' height='250px' width='250px' style='border-top-right-radius: 10px; border-top-left-radius: 10px'>
            <p style='margin: 8px'>Informacije</p>
        </button>

        <div class='modal fade ' id='ad-$i' tabindex='-1' role='dialog' aria-labelledby='ad-$i' aria-hidden='true'>
            <div class='modal-body single-ad'>
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
                        <p class='card-text'><b>Lokacija: </b> $value[location]</p>
                        
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
                        ".($admin ? "
                        <p class='card-text'><small class='text-muted'>$value[email]</small></p>" : "")." 
                    

                        <div class='read-more' onclick=\"$(this).closest('.single-ad').children('.edit').toggle()\"><div>
                            <i class='fas fa-edit'></i>
                            Izmeni
                        </div></div>
                        <div class='read-more' onclick=\"DeleteAd(this, $value[id])\"><div>
                            <i class='fas fa-trash'></i>
                            Izbriši
                        </div></div>
                        <div class='read-more' onclick=\"Block(this, 'ads', $value[id])\"><div>
                            <i class='fas fa-trash'></i>
                            Aktivacija / Blokiranje
                        </div></div>
                        <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                            <span class='message'></span>
                            <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                            </button>
                        </div>
                    </div>
                </div>
            </div>";
            if(sizeof($comments)){
                echo "
                <div class='comments'>
                    ";
            }
                for ($z=0; $z < sizeof($comments); $z++) { 
                    $commentsValue = $comments[$z];
                    if($commentsValue['ads_id'] == $value['id'] && $commentsValue['comment'] != null) {
                        echo "
                        <div class='single-comment card'>
                            <form>
                                <div><input class='form-control' value='$commentsValue[comment]' name='comment'/> -- $commentsValue[email]</div>
                                <div onclick=\"DeleteComment(this, $commentsValue[id])\">
                                    <i class='fas fa-trash'></i>
                                    Izbriši
                                </div>
                                <div onclick=\"updateComment(this, $commentsValue[id])\">
                                    <i class='fas fa-edit'></i>
                                    Izmeni
                                </div>
                                <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                    <span class='message'></span>
                                    <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                    </button>
                                </div>
                            </form>
                        </div>
                        ";
                    };
                };
            if(sizeof($comments)){
                echo "
                </div>
                    ";
            }
            echo "

            <div class='row edit' style='display:none;'>
                <div class=' d-flex align-items-stretch'>
                    <div class='card'>
                        <div class='card-body'>
                            <form>
                                <input name='id' value='$value[id]' hidden/>
                                <h5 class='card-title'>
                                    Izmeni oglas
                                </h5>
                                <div>
                                    <label class='form-label'>Lokacija</label>
                                    <input class='form-control' name='location' value='$value[location]'>
                                </div>
                                <div>
                                    <label class='form-label'>Tip nekretnine</label>
                                    <select class='form-select' name='property_type'>";
                                    for ($y=0; $y < sizeof($propertyData['property_type']); $y++) { 
                                        $propertyValue = $propertyData['property_type'][$y];
                                        echo "<option ".($propertyValue['property_type'] == $value['property_type'] ? "selected='true'" : "")." value='$propertyValue[id]' >$propertyValue[property_type]</option>";
                                    }
                                    echo "
                                    </select>
                                </div>
                                <div>
                                    <label class='form-label'>Opis</label>
                                    <input class='form-control' name='description' value='$value[description]'>
                                </div>
                                <div>
                                    <label class='form-label'>Cena</label>
                                    <input class='form-control' name='price' value='$value[price]'>
                                </div>
                                <div>
                                    <label class='form-label'>Početak iznajmljivanja</label>
                                    <input class='form-control' type='date' name='rent_start' value='$value[rent_start]'>
                                </div>
                                <div>
                                    <label class='form-label'>Kraj iznajmljivanja</label>
                                    <input class='form-control' type='date' name='rent_end' value='$value[rent_end]'>
                                </div>
                                <div class='read-more btn' onclick=\"Update(this, 'ads')\"><div>
                                    <i class='fas fa-edit'></i>
                                    Sačuvaj
                                </div></div>
                                <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                    <span class='message alert'></span>
                                    <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                    </button>
                                </div>
                            <form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        ";
    }
    if(!sizeof($adsData)){
        echo "
        <div style='text-align:center;'>
            Nemaš jos oglasa
        </div>
        ";
    }
}
?>
