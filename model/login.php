<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 6:17 PM
 */

include_once(__DIR__.'/../model/class/UserSession.php');
include_once(__DIR__.'/../model/class/User.php');
include_once(__DIR__.'/../library/db/Connect.class.php');
include_once(__DIR__.'/../lock.php');

header('Content-type: application/json');

$email = isset($_POST["email"])?$_POST["email"]:"";
$password = isset($_POST["password"])?$_POST["password"]:"";

if(empty($email) or empty($password)){
    $response = array('error' => true,
                      'error_message' => 'parameter missing');
    echo json_encode($response);
    die();
}

$user = new User();
$result = $user->login($email,$password);
if($result){
    $_SESSION["user"] = serialize($user->getUserSession());
    $response = array('error' => false,
                      'error_message' => '');
}else{
    $response = array('error' => true,
                      'error_message' => 'Email and password combination not found');
}
echo json_encode($response);
