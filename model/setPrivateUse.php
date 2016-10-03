<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 10:31 PM
 */

include_once(__DIR__.'/../model/class/UserSession.php');
include_once(__DIR__.'/../model/class/Books.php');
include_once(__DIR__.'/../library/db/Connect.class.php');
include_once(__DIR__.'/../lock.php');
header('Content-type: application/json');


$bookId = isset($_POST["bookId"])?$_POST["bookId"]:"";
$status = isset($_POST["status"])?$_POST["status"]:"";
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

if($book->getOwner()!=$userId){
    $response = array('error' => true,
        'error_message' => 'user is not book owner',
        'error_code' => 500);
    echo json_encode($response);
    die();
}

try{
    if($status==BOOK_STATUS_PRIVATE){
        $book->privateUse();
    }elseif ($status==BOOK_STATUS_AVAILABLE){
        $book->makeAvailable();
    }
    $response = array('error' => false,
        'error_message' => '');
}catch(Exception $e) {
    $response = array('error' => true,
        'error_message' => $e->getMessage(),
        'error_code' => 500);
}
echo json_encode($response);