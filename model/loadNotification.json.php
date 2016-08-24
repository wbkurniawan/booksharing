<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 6:17 PM
 */

include_once(__DIR__.'/../library/db/Connect.class.php');
include_once(__DIR__.'/../model/class/Notifications.php');

$true = false;
include_once(__DIR__.'/../lock.php');
header('Content-Type: application/json;charset=utf-8');

if(!isset($_SESSION["user"])){
    echo 0;
    die();
}
$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;

$bookId = isset($_GET["bookId"])?(integer)$_GET["bookId"]:0;

$notifications = new Notifications();
$notifications->setInJson();

if($bookId>0){
    echo $notifications->getNotificationByBookId($userId,$bookId);
}else{
    echo $notifications->getNotificationByUser($userId,null,50);
}
