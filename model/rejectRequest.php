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
$message = isset($_POST["message"])?$_POST["message"]:"";
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
    $book->rejectRequest($message);
    $response = array('error' => false,
        'error_message' => '');
}catch(Exception $e) {
    $response = array('error' => true,
        'error_message' => $e->getMessage(),
        'error_code' => 500);
}
echo json_encode($response);