<?php

/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 1:25 AM
 */
include_once(__DIR__.'/../../config/global.php');
include_once(__DIR__.'/../../library/db/Connect.class.php');
class Authors
{
    private $authors;
    private $filters;
    private $inJSON = false;

    public function __construct()
    {
        $this->db = new Connect(Connect::DBSERVER);
    }

    public function setInJson($inJSON=true){
        $this->inJSON = $inJSON;
    }

    public function getAuthorsByBookId($bookId){
        $query = "SELECT 
                        `author`.`author_id`, `author`.`name`
                    FROM
                        `booksharing`.`author`
                            INNER JOIN
                        `booksharing`.`book_author` ON `author`.`author_id` = `book_author`.`author_id`
                  WHERE `book_author`.`book_id` = ".$bookId." ;";
        $this->authors = $this->db->selectArray($query);
        return $this->getResult();
    }

    public function getAuthorsById($authorId){
        $this->filters[] = " `author`.`author_id` = ".$authorId." ";
        $this->loadAuthors();
        return $this->getResult();
    }

    public function getAuthors(){
        $this->loadAuthors();
        return $this->getResult();
    }

    private function loadAuthors(){
        $filterQuery= "";
        if(count($this->filters)>0){
            $filterQuery = " WHERE ".implode(" AND ",$this->filters);
        }

        $query = "SELECT 
                        `author`.`author_id`, `author`.`name`
                    FROM
                        `booksharing`.`author`                         
                     ".$filterQuery."
                     ORDER by `author`.`name` ASC ;";
        $this->authors = $this->db->selectArray($query);
    }

    public function setNameById($authorId,$name){
        $query = "UPDATE booksharing.author SET name = " . $this->db->quote($name) . " WHERE author_id = " .$authorId;
        $this->db->execute($query);
    }
    public function deleteById($authorId){
        $query = "DELETE FROM booksharing.author WHERE author_id = " .$authorId;
        $this->db->execute($query);
    }
    public function add($name){
        $query = "INSERT INTO booksharing.author (name) values (" . $this->db->quote($name) . ");";
        $this->db->execute($query);
    }

    private function getResult(){
        if($this->inJSON){
            return $this->toJSON();
        }else{
            return $this->authors;
        }
    }

    public function toJSON(){
        $result = ['data'=>$this->authors];
        return json_encode($result);
    }
}