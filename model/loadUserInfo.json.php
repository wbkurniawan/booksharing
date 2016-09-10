<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/6/2016
 * Time: 4:12 PM
 */

include_once(__DIR__.'/../config/global.php');
include_once(__DIR__.'/../model/class/Notifications.php');
$lock = false;
include_once(__DIR__.'/../lock.php');

// set content to json
header('Content-Type: application/json;charset=utf-8');

if(!isset($_SESSION["user"])){
    $response = array('error' => true,
        'error_message' => 'user not logged in',
        'error_code' => 403);
    echo json_encode($response);
    die();
}

//$userSession =  unserialize($_SESSION["user"]);
//$userId = $userSession->userId;
//
//$notification = new Notifications();
//$notification->setInJson();
//
//echo($notification->getNotificationByUser($userId,NOTIFICATION_STATUS_NEW,NOTIFICATIONS_VIEW_LIMIT_HEADER));

$result = ['error'=>false];
echo json_encode($result);