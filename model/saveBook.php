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

if(!isset($_SESSION["user"])){
    $response = array('error' => true,
                      'error_message' => 'user not logged in',
                      'error_code' => 403);
    echo json_encode($response);
    die();
}

$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;


$bookId = isset($_POST["bookId"])?$_POST["bookId"]:0;
$title = isset($_POST["title"])?$_POST["title"]:"";
$description = isset($_POST["description"])?$_POST["description"]:"";
$language = isset($_POST["language"])?$_POST["language"]:"DE";
$isbn = isset($_POST["isbn"])?$_POST["isbn"]:"";
$categoryId = isset($_POST["categoryId"])?$_POST["categoryId"]:0;
$loanPeriod = isset($_POST["loanPeriod"])?$_POST["loanPeriod"]:7;

if($bookId===0 or $categoryId===0){
    $response = array('error' => true,
        'error_message' => "Bad request. Parameter mismatch or missing",
        'error_code' => 400);
    echo json_encode($response);
    die();
}


$book = new Books($bookId);

try{
    $book->setTitle($title);
    $book->setDescription($description);
    $book->setISBN($isbn);
    $book->setLanguage($language);
    $book->setCategoryId($categoryId);
    $book->setLoanPeriod($loanPeriod);
    $book->saveProperties();

    $response = array('error' => false,
        'error_message' => '');
}catch(Exception $e) {
    $response = array('error' => true,
        'error_message' => $e->getMessage(),
        'error_code' => 500);
}
echo json_encode($response);