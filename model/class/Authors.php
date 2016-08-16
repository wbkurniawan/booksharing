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
    public function __construct()
    {
        $this->db = new Connect(Connect::DBSERVER);
    }

    public function getAuthorsByBookId($bookId){
        $query = "SELECT 
                        `author`.`author_id`, `author`.`name`
                    FROM
                        `booksharing`.`author`
                            INNER JOIN
                        `booksharing`.`book_author` ON `author`.`author_id` = `book_author`.`author_id`
                    WHERE
                        `book_author`.`book_id` = ".$bookId.";";
        $authors = $this->db->selectArray($query);
        return $authors;
    }

}