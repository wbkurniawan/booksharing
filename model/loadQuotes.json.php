<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/6/2016
 * Time: 4:12 PM
 */

include_once(__DIR__.'/../model/class/Quotes.php');

// set content to json
header('Content-Type: application/json;charset=utf-8');

$quotes = Quotes::getQuotes();
echo $quotes;
die();