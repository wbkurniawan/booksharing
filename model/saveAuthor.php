<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/17/2016
 * Time: 8:55 PM
 */

include_once(__DIR__.'/../model/class/UserSession.php');
include_once(__DIR__.'/../model/class/User.php');
include_once(__DIR__.'/../model/class/Authors.php');
include_once(__DIR__.'/../library/db/Connect.class.php');
$lock =true;
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
$isAdmin = (integer) $userSession->admin;
if(!$isAdmin){
    $response = array('error' => true,
        'error_message' => 'user not admin',
        'error_code' => 403);
    echo json_encode($response);
    die();
}

$name = isset($_POST["name"])?trim($_POST["name"]):"";
$authorId = isset($_POST["authorId"])?(integer)$_POST["authorId"]:-1;

if($name=="" or $authorId==-1){
    $response = array('error' => true,
        'error_message' => 'parameter missing',
        'error_code' => 403);
    echo json_encode($response);
    die();
}

try{
    $author = new Authors();
    if($authorId==0){
        $author->add($name);
    }else{
        $author->setNameById($authorId,$name);
    }

    $response = array('error' => false,
        'error_message' => '');
}catch(Exception $e) {
    $response = array('error' => true,
        'error_message' => $e->getMessage(),
        'error_code' => 500);
}
echo json_encode($response);