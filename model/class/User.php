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
    private $totalBorrowed;

    public function __construct($userId=null)
    {
        $this->db = new Connect(Connect::DBSERVER);
        if(isset($userId)){
            $this->loadUser($userId);
        }
    }

    public function getUser(){
        if(isset($this->userId)){
            return ["user_id"=>$this->userId,
                "first_name"=>$this->firstName,
                "last_name"=>$this->lastName,
                "email"=>$this->email,
                "status"=>$this->status,
                "total_borrowed"=>$this->totalBorrowed
            ];
        }else{
            return null;
        }

    }

    public function login($email,$password){
        $query = "SELECT 
                `user_id`, `first_name`, `last_name`, `email`, `status`
            FROM
                booksharing.user
            WHERE
                email = ".$this->db->quote($email)." AND status IN ('ACTIVE' , 'NOT_VERIFIED')
                    AND password = AES_ENCRYPT(".$this->db->quote($password).",
                    SHA2('mCe3AAtKLnRt7NskAXmufJMDCgqA73tQ5sQ4Uc3Wumr4W6QyAe',512));";
        $row = $this->db->select($query);

        if(count($row)>0){
            $user = $row[0];
            $this->loadUser($user->user_id);
            return true;
        }else{
            return false;
        }
    }

    private function loadUser($userId){
        $query = "SELECT `user`.`user_id`,
                    `user`.`first_name`,
                    `user`.`last_name`,
                    `user`.`email`,
                    `user`.`status`,
                    `user`.`password`,
                    `user`.`phone`,
                    `user`.`timestamp`,
                    (SELECT count(*) FROM `booksharing`.loan WHERE `user_id` = `user`.`user_id` AND
                     `status` IN ('REQUESTED','BORROWED'))
                     as total_borrowed 
                FROM `booksharing`.`user`                    
                WHERE `user`.`user_id` = ".$userId."; ";
        $users = $this->db->selectArray($query);
        foreach ($users as $index => $user){
            $users[$index] = array_map("utf8_encode",$user);
            $this->userId = $user["user_id"];
            $this->firstName= $user["first_name"];
            $this->lastName = $user["last_name"];
            $this->email = $user["email"];
            $this->status = $user["status"];
            $this->phone = $user["phone"];
            $this->totalBorrowed= $user["total_borrowed"];
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

    public function getTotalNewNotification($userId=null){
        if(!isset($this->userId) and !isset($userId)){
            throw new Exception ("userId required");
        }

        $currentUserId =  isset($userId)?$userId:$this->userId;
        $query = "SELECT count(*) AS total FROM booksharing.notification WHERE user_id = ".$currentUserId." AND status = 'NEW';";
        $row = $this->db->selectValue($query);
        if($row!==false){
            return $row;
        }else{
            return 0;
        }
    }
}