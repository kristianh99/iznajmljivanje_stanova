<?php
require_once '../mvc/controller.php';

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$controller = new Controller();

switch ($_REQUEST["type"]) {
    case 'ads':
        switch ($_REQUEST["status"]) {
            case 'get':
                echo $controller->filterAds($_REQUEST["data"]);
                break;
            case 'update':
                echo $controller->updateAd($_REQUEST["data"]);
                break;
            case 'delete':
                echo $controller->deleteAd($_REQUEST["data"]);
                break;
            case 'create':
                echo $controller->createAd($_REQUEST["data"]);
                break;
            case 'reservate':
                echo $controller->reservateAd($_REQUEST["data"]);
                break;  
            case 'block':
                echo $controller->block($_REQUEST["data"],"ad");
                break;
            };
        break;
    case 'user':
        switch ($_REQUEST["status"]) {
            case 'update':
                echo $controller->updateUser($_REQUEST["data"]);
                break;
            case 'block':
                echo $controller->block($_REQUEST["data"],"user");
                break;
            };
        break;
    case 'messages':
        switch ($_REQUEST["status"]) {
            case 'update':
                echo $controller->updateMessage($_REQUEST["data"]);
                break;
            case 'notification':
                echo $controller->getNotifications();
                break;
            case 'get':
                echo $controller->getMessages($_REQUEST["data"]);
                break;
            };
        break;
    case 'comments':
        switch ($_REQUEST["status"]) {
            case 'create':
                echo $controller->comment($_REQUEST["data"]);
                break;
            case 'update':
                echo $controller->updateComment($_REQUEST["data"]);
                break;
            case 'delete':
                echo $controller->deleteComment($_REQUEST["data"]);
                break;
            };
        break;
    default:
        break;
}

?>