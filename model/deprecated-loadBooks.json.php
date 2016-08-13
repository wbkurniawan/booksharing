<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/6/2016
 * Time: 4:12 PM
 */

include_once(__DIR__.'/../config/global.php');
include_once(__DIR__.'/../model/class/Books.php');
// set content to json
header('Content-Type: application/json;charset=utf-8');

$isRecommended = isset($_GET["recommended"])?$_GET["recommended"]:false;
$isPersonal = isset($_GET["personal"])?$_GET["personal"]:false;
$isLatest = isset($_GET["latest"])?$_GET["latest"]:false;
$bookId = isset($_GET["bookId"])?$_GET["bookId"]:0;
$categoryId = isset($_GET["categoryId"])?$_GET["categoryId"]:0;

$book = new Books();
$book->setInJson();

if($bookId!=0){
    echo($book->getBookById($bookId));
}elseif ($categoryId!=0){
    echo($book->getBooksByCategory($categoryId));
}elseif ($isRecommended){
    echo($book->getBooksRecomended());
}elseif ($isLatest){
    echo($book->getBooksLatest());
}elseif ($isPersonal){
    echo($book->getBooksPersonalRecommendation());
}else{
    echo "invalid parameter";
}
