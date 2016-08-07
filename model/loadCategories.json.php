<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/6/2016
 * Time: 4:12 PM
 */

include_once(__DIR__.'/../config/global.php');
include_once(__DIR__.'/../model/class/Categories.php');
// set content to json
header('Content-Type: application/json;charset=utf-8');

if ( !isset($_SESSION) ) session_start();

if(!isset($_SESSION["categories"])){
    $cat = new Categories();
    $catJSON = $cat->toJSON();
    $_SESSION["categories"] = $catJSON;
    echo $catJSON;
}else{
    echo $_SESSION["categories"];
}
