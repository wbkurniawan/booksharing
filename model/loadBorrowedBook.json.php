<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/6/2016
 * Time: 4:12 PM
 */

include_once(__DIR__.'/../config/global.php');
include_once(__DIR__.'/../model/class/Books.php');
$lock = true;
include_once(__DIR__.'/../lock.php');
// set content to json
header('Content-Type: application/json;charset=utf-8');


$book = new Books();
$book->setInJson();

$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;

echo($book->getBooksBorrowed($userId));
