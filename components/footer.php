<?php
$root = 'https://'.getenv('HTTP_HOST');
if(strpos($_SERVER['PHP_SELF'],basename(__FILE__))){
    header("Location:$root");
}
?>

<footer class="footer" style="width: 100%; height:100px; background:#34495e; text-align:center; color:#fff; margin-top:30px; padding-top:30px;">
    <a href="#" style="font-size: 23px; color:#fff; text-decoration:none">RH</a>
    <br>
    <small>Created by Nikola</small>
</footer> 