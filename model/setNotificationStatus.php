<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 6:17 PM
 */

include_once(__DIR__.'/../library/db/Connect.class.php');
include_once(__DIR__.'/../model/class/UserSession.php');
include_once(__DIR__.'/../model/class/Notifications.php');
$lock = true;
include_once(__DIR__.'/../lock.php');

if(!isset($_SESSION["user"])){
    echo 0;
    die();
}

$notificationId = isset($_POST["notificationId"])?$_POST["notificationId"]:0;
$status = isset($_POST["status"])?$_POST["status"]:0;

if($status===0 or $notificationId===0){
    echo 0;
    die();
}

$notification = new Notifications($notificationId);
$notification->setStatus($status);
echo 1;
