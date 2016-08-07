<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 6:17 PM
 */

include_once(__DIR__.'/../library/db/Connect.class.php');
include_once(__DIR__.'/../model/class/UserSession.php');
include_once(__DIR__.'/../lock.php');

if(!isset($_SESSION["user"])){
    echo 0;
    die();
}
$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;

$db = new Connect(Connect::DBSERVER);
$query = "SELECT count(*) AS total FROM booksharing.user_notification WHERE user_id = ".$userId." AND status = 'NEW';";
$row = $db->selectValue($query);
if($row!==false){
    echo $row;
}else{
    echo 0;
}