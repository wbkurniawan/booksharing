<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 3:51 PM
 */

session_start();
if(isset($lock)){
    if($lock and !isset($_SESSION["user"])){
        header("Location: /booksharing/login.php");
        die();
    }
}
