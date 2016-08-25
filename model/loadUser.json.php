<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/6/2016
 * Time: 4:12 PM
 */

include_once(__DIR__.'/../config/global.php');
include_once(__DIR__.'/../model/class/User.php');
$lock = true;
include_once(__DIR__.'/../lock.php');

// set content to json
header('Content-Type: application/json;charset=utf-8');

if(!isset($_SESSION["user"])){
    $response = array('error' => true,
        'error_message' => 'user not logged in',
        'error_code' => 403);
    echo json_encode($response);
    die();
}

$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;

$user = new User($userId);
$userData = $user->getUser();
echo json_encode(['data'=>$userData]);
