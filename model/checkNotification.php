<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 6:17 PM
 */

include_once(__DIR__.'/../library/db/Connect.class.php');
include_once(__DIR__.'/../model/class/UserSession.php');
include_once(__DIR__.'/../model/class/User.php');
$lock = true;
include_once(__DIR__.'/../lock.php');

if(!isset($_SESSION["user"])){
    echo 0;
    die();
}
$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;

$user = new User(); //don't pass the id here. We just need total new notification
echo $user->getTotalNewNotification($userId);
