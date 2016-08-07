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

$bookId = isset($_POST["bookId"])?$_POST["bookId"]:"";

$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;

$book = new Books($bookId);

try{
    $book->borrowBook($userId);
    echo 1; //Success
}catch(PDOException $e) {
    echo 0; // Error
}
