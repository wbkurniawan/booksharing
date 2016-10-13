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
include_once(__DIR__.'/../lock.php');
include_once(__DIR__.'/../library/sendMail.php');

header('Content-type: application/json');

$invitation = isset($_POST["invitation"])?trim($_POST["invitation"]):"";
$firstName = isset($_POST["firstName"])?trim($_POST["firstName"]):"";
$lastName = isset($_POST["lastName"])?trim($_POST["lastName"]):"";
$email = isset($_POST["email"])?trim($_POST["email"]):"";
$password = isset($_POST["password"])?trim($_POST["password"]):"";
$phone = isset($_POST["phone"])?trim($_POST["phone"]):"";
$newsletterSubscriber= isset($_POST["newsletterSubscriber"])?1:0;

if($invitation==""){
    $response = array('error' => true,
        'error_message' => 'invitation invalid',
        'error_code' => 403);
    echo json_encode($response);
    die();
}

if($firstName=="" or $lastName=="" or $email=="" or $password==""){
    $response = array('error' => true,
        'error_message' => 'parameter missing',
        'error_code' => 403);
    echo json_encode($response);
    die();
}

try{
    $user = new User();
    if(!$user->validateInvitation($invitation)){
        throw new Exception("invitation invalid");
    }
    if(!$user->isEmailAvailable($email)){
        throw new Exception("email address has already been used");
    }


    $user->add($firstName,$lastName,$password,$email,USER_STATUS_NOT_VERIFIED,$phone,$newsletterSubscriber,$invitation);
    $result = $user->login($email,$password);
    if($result) {
        $_SESSION["user"] = serialize($user->getUserSession());
    }

    $emailMessage = file_get_contents(__DIR__."/../doc/registration.txt");
    $emailMessage = str_replace("{{first_name}}",$firstName,$emailMessage);
    sendMail($email,"Booksharing: Registration successful",$emailMessage);
    $response = array('error' => false,
        'error_message' => '');
}catch(Exception $e) {
    $response = array('error' => true,
        'error_message' => $e->getMessage(),
        'error_code' => 500);
}
echo json_encode($response);