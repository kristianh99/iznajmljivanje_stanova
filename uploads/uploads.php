<?php

if($_FILES['file']['name'] != ''){
    $test = explode('.', $_FILES['file']['name']);
    $extension = end($test);    
    $name = rand(100,999).'.'.$extension;

    $location = './'.$name;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);

    echo json_encode(["name" => $name]);
}
?>