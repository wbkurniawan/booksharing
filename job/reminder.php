<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 10/14/2016
 * Time: 9:39 PM
 */
include_once(__DIR__.'/../library/sendMail.php');
include_once(__DIR__.'/../library/db/Connect.class.php');
include_once(__DIR__.'/../model/class/Notifications.php');

$db = new Connect(Connect::DBSERVER);

$query = "SELECT 
                a.user_id, b.user_id AS owner_id, a.book_id, a.loan_id
            FROM
                booksharing.loan a
                    LEFT JOIN
                booksharing.book b ON a.book_id = b.book_id
                    AND a.loan_id = b.current_loan_id
            WHERE
                a.`status` = '".BOOK_STATUS_BORROWED."'
                    AND b.`status` = '".BOOK_STATUS_BORROWED."'
                    AND start_date + INTERVAL a.period DAY = NOW() + INTERVAL ".DUE_DATE_WARNING_DAY." DAY;";

$rows = $db->select($query);
$notification = new Notifications();
foreach ($rows as $row){
    $notification->add($row->user_id,$row->owner_id,NOTIFICATION_TYPE_BORROW_STATUS,"",$row->book_id,null,$row->loan_id);
}

