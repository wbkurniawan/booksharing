<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 6:17 PM
 */

include_once(__DIR__.'/../model/class/UserSession.php');
include_once(__DIR__.'/../library/db/Connect.class.php');

header('Content-type: application/json');

$email = isset($_POST["email"])?$_POST["email"]:"";
$password = isset($_POST["password"])?$_POST["password"]:"";

if(empty($email) or empty($password)){
    $response = array('error' => true,
                      'error_message' => 'parameter missing');
    echo json_encode($response);
    die();
}

$db = new Connect(Connect::DBSERVER);
$query = "SELECT 
                `user_id`, `first_name`, `last_name`, `email`, `status`
            FROM
                booksharing.user
            WHERE
                email = ".$db->quote($email)." AND status IN ('ACTIVE' , 'NOT_VERIFIED')
                    AND password = AES_ENCRYPT(".$db->quote($password).",
                    SHA2('mCe3AAtKLnRt7NskAXmufJMDCgqA73tQ5sQ4Uc3Wumr4W6QyAe',512));";
$row = $db->select($query);
$response = array();
if(count($row)>0){
    if ( !isset($_SESSION) ) session_start();

    $user = $row[0];
    $userSession = new UserSession();
    $userSession->firstName = $user->first_name;
    $userSession->lastName= $user->last_name;
    $userSession->userId = $user->user_id;
    $userSession->email = $user->email;
    $userSession->status = $user->status;
    $_SESSION["user"] = serialize($userSession);
    $response = array('error' => false,
                      'error_message' => '');
}else{
    $response = array('error' => true,
                      'error_message' => 'Email and password combination not found');
}
echo json_encode($response);
