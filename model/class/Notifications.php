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

    public function __construct($notificationId = null)
    {
        $this->notificationId = $notificationId;
        $this->db = new Connect(Connect::DBSERVER);
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
    public function getNotificationByUser($userId,$status=null){
        $this->loadNotification($userId,$status);
        return $this->getResult();
    }

    public function add($userId,$senderUserId,$type,$message,$bookId=null){
        $ta = new TableAdapter($this->db,'booksharing','notification');
        $newNotification = ["user_id"=>$userId,
            "sender_user_id"=>$senderUserId,
            "type"=>$type,
            "message"=>$message,
            "status"=>NOTIFICATION_STATUS_NEW,
            "book_id"=>$bookId];
        $ta->insert($newNotification);
    }

    private function loadNotification($userId=null,$status=null){
        $filters = array();
        if(isset($this->notificationId)){
            $filters[] = "notification.notification_id = " . $this->notificationId;
        }

        if(isset($userId)){
            $filters[] = "notification.user_id = " . $userId;
        }

        if(isset($status)){
            $filters[] = "notification.status = " . $this->db->quote($status);
        }

        $filterQuery = "";
        if(count($filters)>0){
            $filterQuery = " WHERE " . implode(" AND ",$filters);
        }

        $query = " SELECT `notification`.`notification_id`,
                        `notification`.`user_id`,
                        `notification`.`sender_user_id`,
                        `notification`.`type`,
                        `notification`.`message`,
                        `notification`.`status`,
                        `notification`.`book_id`,
                        `notification`.`timestamp`
                    FROM `booksharing`.`notification`
                    ".$filterQuery." ORDER by `notification`.`timestamp` DESC;";

        $this->notifications = $this->db->selectArray($query);
        foreach ($this->notifications as $index => $notification){
            $this->notifications[$index] = array_map("utf8_encode",$notification);
        }
        $this->loadNotificationUser();
    }

    private function loadNotificationUser(){
        foreach ($this->notifications as $index => $notification){
            $sender = new User($notification["sender_user_id"]);
            $recipient = new User($notification["user_id"]);
            $this->notifications[$index]["sender"] = $sender->getUser();
            $this->notifications[$index]["recipient"] = $recipient->getUser();
            unset($this->notifications[$index]["sender_user_id"]);
            unset($this->notifications[$index]["user_id"]);
        }
    }

    public function toJSON(){
        $result = ['data'=>$this->notifications];
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