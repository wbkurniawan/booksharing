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
    $response = array('error' => true,
        'error_message' => 'user not logged in',
        'error_code' => 403);
    echo json_encode($response);
    die();
}

$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;

$replyFromId = isset($_POST["replyFromId"])?$_POST["replyFromId"]:0;
$recipient = isset($_POST["recipient"])?$_POST["recipient"]:0;
$message = isset($_POST["message"])?$_POST["message"]:"";
$bookId = isset($_POST["bookId"])?$_POST["bookId"]:null;
$type = isset($_POST["type"])?$_POST["type"]:0;

if($recipient===0 or $type===0){
    $response = array('error' => true,
        'error_message' => "Bad request. Parameter missing",
        'error_code' => 400);
    echo json_encode($response);
    die();
}

try{
    $notification = new Notifications();
    $notification->add($recipient,$userId,$type,$message,$bookId,$replyFromId);

    $response = array('error' => false,
        'error_message' => '');
}catch(Exception $e) {
    $response = array('error' => true,
        'error_message' => $e->getMessage(),
        'error_code' => 500);
}
;
echo json_encode($response);
