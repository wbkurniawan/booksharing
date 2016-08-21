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

if(!isset($_SESSION["user"])){
    $response = array('error' => true,
                      'error_message' => 'user not logged in',
                      'error_code' => 403);
    echo json_encode($response);
    die();
}

$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;


$bookId = isset($_POST["bookId"])?(integer)$_POST["bookId"]:-1;
$title = isset($_POST["title"])?$_POST["title"]:"";
$description = isset($_POST["description"])?$_POST["description"]:"";
$language = isset($_POST["language"])?$_POST["language"]:"DE";
$isbn = isset($_POST["isbn"])?$_POST["isbn"]:"";
$categoryId = isset($_POST["categoryId"])?(integer)$_POST["categoryId"]:0;
$loanPeriod = isset($_POST["loanPeriod"])?(integer)$_POST["loanPeriod"]:7;
$authorIds =  isset($_POST["authorIds"])?$_POST["authorIds"]:[];

if($bookId===-1 or $categoryId===0){
    $response = array('error' => true,
        'error_message' => "Bad request. Parameter mismatch or missing",
        'error_code' => 400);
    echo json_encode($response);
    die();
}

$addNewBook = false;
if($bookId==0) { //Add new book;
    $book = new Books();
    $bookId = $book->add($userId);
    $addNewBook = true;
}
$book = new Books($bookId);

try{
    $book->setTitle($title);
    $book->setDescription($description);
    $book->setISBN($isbn);
    $book->setLanguage($language);
    $book->setCategoryId($categoryId);
    $book->setLoanPeriod($loanPeriod);
    $book->setAuthorIds($authorIds);
    $book->saveProperties();

    if($addNewBook){
        $notification = new Notifications();
        $notification->add(USER_ID_ADMIN,$userId,NOTIFICATION_TYPE_BOOK_APPROVAL_REQUEST,"New book needs your approval",$bookId);
    }

    $response = array('error' => false,
                      'error_message' => '',
                      'book_id' => $bookId);
}catch(Exception $e) {
    $response = array('error' => true,
        'error_message' => $e->getMessage(),
        'error_code' => 500);
}
echo json_encode($response);