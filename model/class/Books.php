<?php

/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/6/2016
 * Time: 1:46 PM
 */
include_once(__DIR__.'/../../config/global.php');
include_once(__DIR__.'/../../library/db/Connect.class.php');
include_once(__DIR__.'/../../library/db/TableAdapter.class.php');
include_once(__DIR__.'/../../model/class/Categories.php');
include_once(__DIR__.'/../../model/class/Authors.php');
include_once(__DIR__.'/../../model/class/User.php');
include_once(__DIR__.'/../../model/class/Notifications.php');
class Books
{

    private $db;
    private $bookId;
    private $books;
    private $inJSON;
    private $page;
    private $filters;
    private $orders;
    private $foundRows;
    private $returnStats;

    /**
     * Books constructor.
     */
    public function __construct($bookId = null)
    {
        $this->bookId = $bookId;
        $this->db = new Connect(Connect::DBSERVER);
        $this->page = 1;
        $this->returnStats = false;
    }

    public function setInJson($inJSON=true){
        $this->inJSON = $inJSON;
    }

    public function setReturnStats($returnStats=true){
        $this->returnStats = $returnStats;
    }

    public function getBook()
    {
        if(isset($this->bookId)){
            $this->loadBooks();
            return $this->getResult();
        }else{
            return null;
        }
    }
    public function getBookById($bookId)
    {
        $this->bookId = $bookId;
        $this->loadBooks();
        if(isset($this->books[0])){
            $authors = new Authors();
            $this->books[0]["authors"] = $authors->getAuthorsByBookId($bookId);
            if(!empty($this->books[0]["user_id"])){
                $user = new User($this->books[0]["user_id"]);
                $this->books[0]["user"] = $user->getUser();
            }
        }
        return $this->getResult();
    }
    public function getBooksByPage($page,$limit=BOOKS_VIEW_LIMIT_DEFAULT)
    {
        $this->page = $page;
        $this->loadBooks($this->page,$limit);
        return $this->getResult();
    }
    public function getBooksByCategory($categoryId,$page=1,$limit=BOOKS_VIEW_LIMIT_DEFAULT)
    {
        $this->page = $page;
        $this->filters = ["`book`.`category_id` = " . $categoryId];
        $this->loadBooks($this->page,$limit);
        return $this->getResult();
    }
    public function getBooksRecomended(){

        $this->filters = ["`book`.`recommended` = 1"];
        $this->loadBooks(1,BOOKS_VIEW_LIMIT_RECOMENDED);
        return $this->getResult();
    }
    public function getBooksLatest(){

        $this->orders = ["`book`.`enter_date` DESC"];
        $this->loadBooks(1,BOOKS_VIEW_LIMIT_LATEST);
        return $this->getResult();
    }

    public function getBooksPersonalRecommendation($userId = null){
        $this->filters = ["`book`.`status` = '".BOOK_STATUS_AVAILABLE."'"];
        $this->orders = ["rand()"];

        $this->loadBooks(1,BOOKS_VIEW_LIMIT_RECOMENDED);
        return $this->getResult();
    }

    public function toJSON(){
        $categories = new Categories();
        foreach ($this->books as $index => $book){

            $categoriesJSON = [$categories->getCategoryById($book["category_id"])];
            $this->books[$index]["categories"] = $categoriesJSON;
        }

        $result = ['data'=>$this->books,
                   'page'=>$this->page];
        if($this->returnStats){
            $result[0]['stats'] = ['total'=>$this->foundRows];
        }
        return json_encode($result);
    }

    private function loadBooks($page=1,$limit=BOOKS_VIEW_LIMIT_DEFAULT){
        if(isset($this->bookId)){
            $this->filters[] = "book.book_id = ".$this->bookId;
        }

        $filterQuery = "";
        if(count($this->filters)>0){
            $filterQuery = " WHERE " . implode(" AND ",$this->filters);
        }

        $orderQuery = "";
        if(count($this->orders)>0){
            $orderQuery = " ORDER BY " . implode(" , ",$this->orders);
        }


        $queries["command"] = " SELECT ";
        if($this->returnStats){
            $queries["option"] = " SQL_CALC_FOUND_ROWS ";
        }
        $queries["fields"] = " `book`.`book_id`,
                               `book`.`title`,
                               `book`.`description`,
                               `book`.`category_id`,
                               `book`.`isbn`,
                               `book`.`publisher_id`,
                               `book`.`language`,
                               `book`.`user_id`,
                               `book`.`status`,
                               `book`.`loan_period`,
                               `book`.`enter_date`,
                               `book`.`recommended`,
                               `book`.`rating`,
                                GROUP_CONCAT(`author`.`name` SEPARATOR ', ') as authors ";
        $queries["tables"] = "  FROM `booksharing`.`book`
                                LEFT JOIN `booksharing`.`book_author` ON `book`.`book_id` = `booksharing`.`book_author`.`book_id` 
                                LEFT JOIN `booksharing`.`author` ON `author`.`author_id` = `booksharing`.`book_author`.`author_id` 
                                 ";
        $queries["conditions"] = $filterQuery;
        $queries["group"] = " GROUP BY  `book`.`book_id` ";
        $queries["order"] = $orderQuery;
        $queries["limit"] = " LIMIT ".(($page-1)*$limit).",".$limit;

        $query = implode("",$queries);
        $this->books = $this->db->selectArray($query);
        if($this->returnStats){
            $this->foundRows = $this->db->selectValue("SELECT FOUND_ROWS();");
        }
        foreach ($this->books as $index => $book){
            $this->books[$index] = array_map("utf8_encode",$book);
        }
    }

    public function borrowBook($userId)
    {
        if(isset($this->bookId)){
            $userObj = new User($userId);
            $user = $userObj->getUser();
            $totalBorrowed = 0;
            if(isset($user)){
                $totalBorrowed = $user["total_borrowed"];
                if($totalBorrowed>=MAX_BORROWED_BOOK){
                    throw new Exception ("Maximum book ".MAX_BORROWED_BOOK);
                }
            }else{
                throw new Exception ("User not found");
            }
            $owner = $this->getOwner($this->bookId);
            if($userId==$owner){
                throw new Exception ("User is the owner of the book");
            }

            if($this->checkStatus()==BOOK_STATUS_AVAILABLE){
                $ta = new TableAdapter($this->db,'booksharing','loan');
                $newLoan = ["book_id"=>$this->bookId,
                            "user_id"=>$userId,
                            "status"=>LOAN_STATUS_REQUESTED];
                $ta->insert($newLoan);
                $query = "UPDATE `booksharing`.`book` SET `status` = '".BOOK_STATUS_RESERVED."' WHERE `book_id` = " .$this->bookId;
                $this->db->execute($query);

                $message = "Hi, i would like to borrow your book";
                //todo: get the message from dictionary

                $notification = new Notifications();
                $notification->add($owner,$userId,NOTIFICATION_TYPE_BORROW_REQUEST,$message,$this->bookId);

            }else{
                throw new Exception ("Book not available");
            }
        }else{
            throw new Exception ("bookId required");
        }
    }

    public function checkStatus(){
        if(isset($this->bookId)){
            $query = "SELECT status FROM `booksharing`.`book` WHERE `book_id` = ".$this->bookId;
            return $this->db->selectValue($query);
        }else{
            throw new Exception ("bookId required");
        }
    }

    public function  getOwner(){
        if(isset($this->bookId)){
            $query = "SELECT user_id FROM `booksharing`.`book` WHERE `book_id` = ".$this->bookId;
            return $this->db->selectValue($query);
        }else{
            throw new Exception ("bookId required");
        }
    }

    private function getResult(){
        if($this->inJSON){
            return $this->toJSON();
        }else{
            return $this->books;
        }
    }
}