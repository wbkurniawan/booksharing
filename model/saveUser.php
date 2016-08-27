<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/17/2016
 * Time: 8:55 PM
 */

include_once(__DIR__.'/../model/class/UserSession.php');
include_once(__DIR__.'/../model/class/User.php');
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

$firstName = isset($_POST["firstName"])?trim($_POST["firstName"]):"";
$lastName = isset($_POST["lastName"])?trim($_POST["lastName"]):"";
$email = isset($_POST["email"])?trim($_POST["email"]):"";
$password = isset($_POST["password"])?trim($_POST["password"]):"";
$phone = isset($_POST["phone"])?trim($_POST["phone"]):"";

if($firstName=="" or $lastName=="" or $email=="" or $password==""){
    $response = array('error' => true,
        'error_message' => 'parameter missing',
        'error_code' => 403);
    echo json_encode($response);
    die();
}

try{
    $user = new User($userId);
    $user->update($firstName,$lastName,$password,$email,$phone);

    $response = array('error' => false,
        'error_message' => '');
}catch(Exception $e) {
    $response = array('error' => true,
        'error_message' => $e->getMessage(),
        'error_code' => 500);
}
echo json_encode($response);