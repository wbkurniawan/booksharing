<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/6/2016
 * Time: 4:12 PM
 */

include_once(__DIR__.'/config/global.php');
include_once(__DIR__.'/model/class/Books.php');
include_once(__DIR__.'/model/class/Categories.php');
include_once(__DIR__.'/model/class/Notifications.php');
header('Content-Type: application/json;charset=utf-8');

$book = new Books(2);
$book->borrowBook(1);
//$book->setInJson();
//$book->setReturnStats(true);
//header('Content-Type: application/json');

//echo($book->getBooksRecomended());
//echo($book->getBooksByCategory(1));
//echo($book->getBooksLatest());
//echo($book->getBookById(2));
//echo($book->getPersonalRecommendation());
//echo($book->getBooksByPage(1,15));

//$cat = new Categories();
//print_r($cat->getCategoryById(1));
//echo $cat->toJSON();
//print_r($cat->getCategories());

//$notification = new Notifications();
//$notification->setInJson();
//print_r( $notification->getNotification());
//print_r($notification->getNotificationById(1));
//print_r($notification->getNotificationByUser(2,NOTIFICATION_STATUS_NEW));
//$notification->setInJson();
