<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 10/13/2016
 * Time: 7:14 PM
 */

include_once(__DIR__.'/../library/sendMail.php');
include_once(__DIR__.'/../library/db/Connect.class.php');

$db = new Connect(Connect::DBSERVER);

//enum('BORROW_REQUEST','BORROW_REJECT','BORROW_ACCEPT','BORROW_STATUS','SYSTEM','USER_TO_USER','BOOK_APPROVAL_REQUEST')

$query = "SELECT 
                a.notification_id,
                a.type,
                b.first_name,
                b.last_name,
                b.email,
                b.phone,
                c.first_name as sender_first_name,
                c.last_name as sender_last_name,
                c.email as sender_email,
                c.phone as sender_phone,
                d.title,
                if(a.type='BORROW_REJECT',a.message,'') as message
            FROM
                booksharing.notification a
                    LEFT JOIN
                booksharing.user b ON a.user_id = b.user_id
                    LEFT JOIN
                booksharing.user c ON a.sender_user_id = c.user_id
                    LEFT JOIN
                booksharing.book d ON a.book_id = d.book_id
            WHERE
                a.email_sent = 0;";

$rows = $db->select($query);
foreach ($rows as $row){
    switch ($row->type) {
        case NOTIFICATION_TYPE_BORROW_REQUEST:
            $emailBody = render($row,"borrowRequestBorrower.txt");
            sendMail($row->sender_email,"Borrow Request",$emailBody);
            $emailBody = render($row,"borrowRequestOwner.txt");
            sendMail($row->email,"Borrow Request from ".$row->sender_first_name,$emailBody);
            break;
        case NOTIFICATION_TYPE_BORROW_REJECT:
            $emailBody = render($row,"borrowReject.txt");
            sendMail($row->email,"Borrow Request Rejected",$emailBody);
            break;
        case NOTIFICATION_TYPE_BORROW_ACCEPT:
            $emailBody = render($row,"borrowAccept.txt");
            sendMail($row->email,"Borrow Request Accepted",$emailBody);
            break;
        case NOTIFICATION_TYPE_BOOK_APPROVAL_REQUEST:
            $emailBody = render($row,"bookApprovalRequest.txt");
            sendMail($row->email,"Book Approval Request from ".$row->sender_first_name,$emailBody);
            break;
        case NOTIFICATION_TYPE_BORROW_STATUS:
            $emailBody = render($row,"borrowStatus.txt");
            sendMail($row->email,"Book Approval Reminder",$emailBody);
            break;
    }
    $query = "UPDATE booksharing.notification SET email_sent = 1 WHERE notification_id = " . $row->notification_id;
    $db->execute($query);
}

function render($row,$template){
    $emailMessage = file_get_contents(__DIR__."/../doc/".$template);
    $emailMessage = str_replace("{{first_name}}",$row->first_name,$emailMessage);
    $emailMessage = str_replace("{{last_name}}",$row->last_name,$emailMessage);
    $emailMessage = str_replace("{{email}}",$row->email,$emailMessage);
    $emailMessage = str_replace("{{phone}}",$row->phone,$emailMessage);
    $emailMessage = str_replace("{{sender_first_name}}",$row->sender_first_name,$emailMessage);
    $emailMessage = str_replace("{{sender_last_name}}",$row->sender_last_name,$emailMessage);
    $emailMessage = str_replace("{{sender_email}}",$row->sender_email,$emailMessage);
    $emailMessage = str_replace("{{sender_phone}}",$row->sender_phone,$emailMessage);
    $emailMessage = str_replace("{{title}}",$row->title,$emailMessage);
    $emailMessage = str_replace("{{message}}",$row->message,$emailMessage);
    return $emailMessage;
}