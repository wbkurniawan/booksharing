<?php

/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 1:25 AM
 */
include_once(__DIR__.'/../../config/global.php');
include_once(__DIR__.'/../../library/db/Connect.class.php');
include_once(__DIR__.'/../../model/class/UserSession.php');
class User
{
    private $userId;
    private $firstName;
    private $lastName;
    private $email;
    private $status;
    private $phone;

    public function __construct($userId=null)
    {
        $this->db = new Connect(Connect::DBSERVER);
        if(isset($userId)){
            $this->loadUser($userId);
        }
    }

    public function getUser(){
        return ["user_id"=>$this->userId,
                "first_name"=>$this->firstName,
                "last_name"=>$this->lastName,
                "email"=>$this->email,
                "status"=>$this->status];
    }

    private function loadUser($userId){
        $query = "SELECT `user`.`user_id`,
                        `user`.`first_name`,
                        `user`.`last_name`,
                        `user`.`email`,
                        `user`.`status`,
                        `user`.`password`,
                        `user`.`phone`,
                        `user`.`timestamp`
                    FROM `booksharing`.`user` WHERE `user`.`user_id` = ".$userId."; ";
        $users = $this->db->selectArray($query);
        foreach ($users as $index => $user){
            $users[$index] = array_map("utf8_encode",$user);
            $this->userId = $user["user_id"];
            $this->firstName= $user["first_name"];
            $this->lastName = $user["last_name"];
            $this->email = $user["email"];
            $this->status = $user["status"];
            $this->phone = $user["phone"];
        }
    }

    public function getUserSession(){
        $userSession = new UserSession();
        $userSession->userId = $this->userId;
        $userSession->firstName = $this->firstName;
        $userSession->lastName = $this->lastName;
        $userSession->status = $this->status;
        $userSession->email = $this->email;
        return $userSession;
    }
}