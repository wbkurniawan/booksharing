<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 10:31 PM
 */

include_once(__DIR__.'/../model/class/UserSession.php');
include_once(__DIR__.'/../model/class/Books.php');
include_once(__DIR__.'/../model/class/Notifications.php');
include_once(__DIR__.'/../library/db/Connect.class.php');
include_once(__DIR__.'/../lock.php');
header('Content-type: application/json');


$bookId = isset($_POST["bookId"])?$_POST["bookId"]:"";
$notificationId = isset($_POST["notificationId"])?(integer)$_POST["notificationId"]:0;
$type = isset($_POST["type"])?$_POST["type"]:"";

if(!isset($_SESSION["user"])){
    $response = array('error' => true,
                      'error_message' => 'user not logged in',
                      'error_code' => 403);
    echo json_encode($response);
    die();
}

$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;

$book = new Books($bookId);

try{
    if($type==NOTIFICATION_TYPE_BOOK_APPROVAL_REQUEST){
        if($userSession->admin){
            $book->makeAvailable();
        }else{
            throw new Exception ("Not authorized");
        }
    }elseif ($type==NOTIFICATION_TYPE_BORROW_REQUEST){
        $book->approveRequest();
    }else{
        throw new Exception ("type unknown");
    }

    if($notificationId!=0){
        $notification = new Notifications($notificationId);
        $notification->setStatus(NOTIFICATION_STATUS_PROCESSED);
    }
    $response = array('error' => false,
        'error_message' => '');
}catch(Exception $e) {
    $response = array('error' => true,
        'error_message' => $e->getMessage(),
        'error_code' => 500);
}
echo json_encode($response);