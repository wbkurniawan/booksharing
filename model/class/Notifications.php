<?php

/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/9/2016
 * Time: 9:41 PM
 */

include_once(__DIR__.'/../../config/global.php');
include_once(__DIR__.'/../../library/db/Connect.class.php');
include_once(__DIR__.'/../../library/db/TableAdapter.class.php');
include_once(__DIR__.'/../../model/class/User.php');
class Notifications
{
    private $notificationId;
    private $notifications;
    private $inJSON;
    private $filters;

    public function __construct($notificationId = null)
    {
        $this->notificationId = $notificationId;
        $this->db = new Connect(Connect::DBSERVER);
        $this->filters = array();
    }
    public function setInJson($inJSON=true){
        $this->inJSON = $inJSON;
    }
    public function getNotification(){
        if(isset($this->notificationId)){
            $this->loadNotification();
            return $this->getResult();
        }else{
            return null;
        }
    }
    public function getNotificationById($notificationId){
        $this->notificationId = $notificationId;
        $this->loadNotification();
        return $this->getResult();
    }
    public function getNotificationByUser($userId,$status=null,$limit){
        $this->loadNotification($userId,$status,$limit);
        return $this->getResult();
    }
    public function getNotificationByBookId($userId,$bookId){
        $this->filters[] = "notification.book_id = " . $bookId;
        $this->loadNotification($userId);
        return $this->getResult();
    }

    public function add($userId,$senderUserId,$type,$message,$bookId=null,$replyFromId=null,$loanId=null){
        $ta = new TableAdapter($this->db,'booksharing','notification');
        $newNotification = ["user_id"=>$userId,
            "sender_user_id"=>$senderUserId,
            "type"=>$type,
            "message"=>$message,
            "status"=>NOTIFICATION_STATUS_NEW,
            "book_id"=>$bookId,
            "reply_from_id"=>$replyFromId,
            "loan_id"=>$loanId];
        $ta->insert($newNotification);
    }

    public function setStatus($status){
        if(isset($this->notificationId)){
            try{
                $query = "UPDATE booksharing.notification SET status = " . $this->db->quote($status) ." 
                      WHERE notification_id = ". $this->notificationId ." ;";
                $this->db->execute($query);
                return true;
            }catch (Exception $e){
                return false;
            }
        }else{
            return false;
        }
    }

    private function loadNotification($userId=null,$status=null,$limit=null){

        if(isset($this->notificationId)){
            $this->filters[] = "notification.notification_id = " . $this->notificationId;
        }

        if(isset($userId)){
            $this->filters[] = "notification.user_id = " . $userId;
            $this->filters[] = "notification.status <> '".NOTIFICATION_STATUS_DELETED."' ";
        }

        if(isset($status)){
            $this->filters[] = "notification.status = " . $this->db->quote($status);
        }

        $filterQuery = "";
        if(count($this->filters)>0){
            $filterQuery = " WHERE " . implode(" AND ",$this->filters);
        }

        $limitQuery = "";
        if(isset($limit)){
            $limitQuery = " LIMIT 0,".$limit;
        }
        $query = " SELECT `notification`.`notification_id`,
                        `notification`.`user_id`,
                        `notification`.`sender_user_id`,
                        `notification`.`type`,
                        `notification`.`message`,
                        `notification`.`status`,
                        `notification`.`book_id`,
                        DATE_FORMAT(`notification`.`timestamp`,'%d %b %Y %T') as timestamp,
                        `notification`.`loan_id`,
                        `loan`.`status` as `loan_status` ,
                        `book`.`title`,
                        `book`.`image`                        
                    FROM `booksharing`.`notification`
                    LEFT JOIN `booksharing`.`loan` ON `notification`.`loan_id` = `loan`.`loan_id` 
                    LEFT JOIN `booksharing`.`book` ON `notification`.`book_id` = `book`.`book_id` 
                    ".$filterQuery." ORDER by `notification`.`timestamp` DESC ".$limitQuery.";";

        $this->notifications = $this->db->selectArray($query);
        $this->loadNotificationUser();
    }

    private function loadNotificationUser(){
        $users = array();
        foreach ($this->notifications as $index => $notification){
            $sender = null;
            if(isset($users[$notification["sender_user_id"]])){
                $sender = $users[$notification["sender_user_id"]];
            }else{
                $sender = new User($notification["sender_user_id"]);
                $users[$notification["sender_user_id"]] = $sender;
            }

            $recipient = null;
            if(isset($users[$notification["user_id"]])){
                $recipient = $users[$notification["user_id"]];
            }else{
                $recipient = new User($notification["user_id"]);
                $users[$notification["user_id"]] = $recipient;
            }

            $this->notifications[$index]["sender"] = $sender->getUser();
            $this->notifications[$index]["recipient"] = $recipient->getUser();
            unset($this->notifications[$index]["sender_user_id"]);
            unset($this->notifications[$index]["user_id"]);
        }
    }

    public function toJSON(){
        $result = ['data'=>$this->notifications,
                    'error'=>false];
        return json_encode($result);
    }

    private function getResult(){
        if($this->inJSON){
            return $this->toJSON();
        }else{
            return $this->notifications;
        }
    }

}