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

$cat = new Categories();
echo $cat->toJSON();