<?php

/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 1:25 AM
 */
include_once(__DIR__.'/../../config/global.php');
include_once(__DIR__.'/../../library/db/Connect.class.php');
include_once(__DIR__.'/../../library/db/TableAdapter.class.php');
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
    private $admin;

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
                "total_borrowed"=>$this->totalBorrowed,
                "admin"=>$this->admin,
                "phone"=>$this->phone
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

    public function add($firstName,$lastName,$password,$email,$status=USER_STATUS_NOT_VERIFIED,$phone="",$newsletterSubscriber=0,$invitation){
        $ta = new TableAdapter($this->db,'booksharing','user');
        $token = uniqid();
        $newUser = ["first_name"=>$firstName,
                    "last_name"=>$lastName,
                    "email"=>$token,
                    "status"=>$status,
                    "phone"=>$phone,
                    "invitation_id"=>$invitation,
                    "newsletter_subscriber"=>$newsletterSubscriber];
        $ta->insert($newUser);
        $query = "UPDATE booksharing.user 
                  SET email = " . $this->db->quote($email). ", 
                      password = AES_ENCRYPT(".$this->db->quote($password).",
                      SHA2('mCe3AAtKLnRt7NskAXmufJMDCgqA73tQ5sQ4Uc3Wumr4W6QyAe',512))
                  WHERE email = " .$this->db->quote($token);
        $this->db->execute($query);
    }

    public function update($firstName,$lastName,$email,$phone=""){
        if(isset($this->userId)){
            $ta = new TableAdapter($this->db,'booksharing','user');
            $newUser = ["user_id" => $this->userId,
                "first_name"=>$firstName,
                "last_name"=>$lastName,
                "email"=>$email,
                "phone"=>$phone];
            $ta->insert($newUser,true);
        }else{
            throw new Exception("user id not found");
        }
    }

    public function updatePassword($oldPassword,$newPassword){
        if(isset($this->userId)){

            $query = "SELECT 
                `user_id`
            FROM
                booksharing.user
            WHERE
                user_id = ".$this->userId." 
                AND password = AES_ENCRYPT(".$this->db->quote($oldPassword).",
                    SHA2('mCe3AAtKLnRt7NskAXmufJMDCgqA73tQ5sQ4Uc3Wumr4W6QyAe',512));";
            $row = $this->db->select($query);

            if(count($row)>0){
                $query = "UPDATE booksharing.user 
                  SET password = AES_ENCRYPT(".$this->db->quote($newPassword).",
                      SHA2('mCe3AAtKLnRt7NskAXmufJMDCgqA73tQ5sQ4Uc3Wumr4W6QyAe',512))
                  WHERE user_id = " .$this->userId;
                $this->db->execute($query);
            }else{
                throw new Exception("user id not found or password doesn't match");
            }
        }else{
            throw new Exception("user id not found");
        }
    }

    public function validateInvitation($invitation){
        $query = "SELECT count(*) as valid FROM booksharing.invitation WHERE invitation_id = ".$this->db->quote(trim($invitation))." and expired_date > now()";
        $valid = (integer) $this->db->selectValue($query);
        return $valid==1?true:false;
    }

    public function isEmailAvailable($email){
        $query = "SELECT count(*) as total FROM booksharing.user WHERE email = ".$this->db->quote(trim($email)).";";
        $total = (integer) $this->db->selectValue($query);
        return $total==0?true:false;
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
                    `user`.`admin`,
                    (SELECT count(*) FROM `booksharing`.loan WHERE `user_id` = `user`.`user_id` AND
                     `status` IN ('REQUESTED','BORROWED'))
                     as total_borrowed 
                FROM `booksharing`.`user`                    
                WHERE `user`.`user_id` = ".$userId."; ";
        $users = $this->db->selectArray($query);
        foreach ($users as $index => $user){
            $this->userId = $user["user_id"];
            $this->firstName= $user["first_name"];
            $this->lastName = $user["last_name"];
            $this->email = $user["email"];
            $this->status = $user["status"];
            $this->phone = $user["phone"];
            $this->totalBorrowed= $user["total_borrowed"];
            $this->admin= $user["admin"];
        }
    }

    public function getUserSession(){
        $userSession = new UserSession();
        $userSession->userId = $this->userId;
        $userSession->firstName = $this->firstName;
        $userSession->lastName = $this->lastName;
        $userSession->status = $this->status;
        $userSession->email = $this->email;
        $userSession->admin = $this->admin;
        return $userSession;
    }

    public function getTotalNewNotification($userId=null){
        if(!isset($this->userId) and !isset($userId)){
            throw new Exception ("userId required");
        }

        $currentUserId =  isset($userId)?$userId:$this->userId;
        $query = "SELECT count(*) AS total FROM booksharing.notification WHERE user_id = ".$currentUserId." AND status = 'NEW';";
//        $query = "SELECT count(*) as total FROM booksharing.notification a
//                    LEFT JOIN booksharing.loan b USING(loan_id) WHERE a.user_id = ".$currentUserId."
//                    AND (b.status IN ('".LOAN_STATUS_REQUESTED."','".LOAN_STATUS_BORROWED."')
//                    OR a.status = '".NOTIFICATION_STATUS_NEW."');";
        $row = $this->db->selectValue($query);
        if($row!==false){
            return $row;
        }else{
            return 0;
        }
    }
}