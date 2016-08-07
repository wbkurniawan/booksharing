<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 6:17 PM
 */

include_once(__DIR__.'/../model/class/UserSession.php');
include_once(__DIR__.'/../library/db/Connect.class.php');

$email = isset($_GET["email"])?$_GET["email"]:"";
$password = isset($_GET["password"])?$_GET["password"]:"";

if(empty($email) or empty($password)){
    echo 0;
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
    echo 1;
    die();
}else{
    echo 0;
    die();
}