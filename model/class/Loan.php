<?php

/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/6/2016
 * Time: 1:46 PM
 */
include_once(__DIR__.'/../../config/global.php');
include_once(__DIR__.'/../../library/db/Connect.class.php');
class Loan
{

    private $db;
    private $loans;
    private $inJSON;
    private $loanId;

    public function __construct($loanId=null)
    {
        $this->db = new Connect(Connect::DBSERVER);
        if(isset($loanId)){
            $this->loanId = $loanId;
            $this->loadLoan();
        }
    }

    public function setInJson($inJSON=true){
        $this->inJSON = $inJSON;
    }
    public function getLoan(){
        return $this->getResult();
    }
    private function loadLoan(){
        if(isset($this->loanId)){
            $query = "SELECT 
                    a.loan_id,
                    a.book_id,
                    a.user_id,
                    c.first_name,
                    c.last_name,
                    c.email,
                    a.start_date,
                    a.returned_date,
                    a.period,
                    a.status,
                    a.timestamp
                FROM
                    booksharing.loan a
                        LEFT JOIN
                    booksharing.user c ON a.user_id = c.user_id
                WHERE a.loan_id = ".$this->loanId.";";
            $this->loans = $this->db->selectArray($query);
        }
    }

//    public function getLoanByBookId($bookId,$limit=LOAN_VIEW_LIMIT_DEFAULT)
//    {
//        $query = "SELECT
//                    a.loan_id,
//                    a.book_id,
//                    b.title,
//                    a.user_id,
//                    c.first_name,
//                    c.last_name,
//                    c.email,
//                    a.start_date,
//                    a.returned_date,
//                    a.period,
//                    a.status,
//                    a.timestamp
//                FROM
//                    booksharing.loan a
//                        LEFT JOIN
//                    booksharing.book b ON a.book_id = b.book_id
//                        LEFT JOIN
//                    booksharing.user c ON a.user_id = c.user_id;";
//        $this->loans = $this->db->selectArray($query);
//        return $this->getResult();
//    }


    public function toJSON(){
        return json_encode([
            'data'=>array_values($this->loans),
            'stats'=>['total'=>count($this->loans)],
            'page'=>1,
        ],JSON_UNESCAPED_UNICODE );
    }


    private function getResult(){
        if($this->inJSON){
            return $this->toJSON();
        }else{
            return $this->loans;
        }
    }
}