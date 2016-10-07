<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/13/2016
 * Time: 10:27 AM
 */

$lock = false;
include_once(__DIR__.'/../lock.php');

$_SESSION["user"] = null;
$_SESSION["categories"] = null;

session_destroy();
header("Location: /login.php");