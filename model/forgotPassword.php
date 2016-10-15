<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 10/15/2016
 * Time: 2:39 PM
 */

include_once(__DIR__.'/../library/db/Connect.class.php');
include_once(__DIR__.'/../library/sendMail.php');
include_once(__DIR__.'/../model/class/User.php');

header('Content-type: application/json');

$email = isset($_POST["email"])?trim($_POST["email"]):"";
if($email==""){
    $response = array('error' => true,
        'error_message' => 'parameter missing',
        'error_code' => 403);
    echo json_encode($response);
    die();
}

$user = new User();
try{
    $code = $user->requestResetPassword($email);

    $emailMessage = file_get_contents(__DIR__."/../doc/resetPassword.txt");
    $emailMessage = str_replace("{{code}}",$code,$emailMessage);
    $response = array('error' => false,
                      'error_message' => '');
    sendMail($email,"Booksharing: Reset password",$emailMessage);

}catch(Exception $e) {
    $response = array('error' => true,
        'error_message' => $e->getMessage(),
        'error_code' => 500);
}
echo json_encode($response);
