<?php

/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/6/2016
 * Time: 1:46 PM
 */
include_once(__DIR__.'/../../config/global.php');
include_once(__DIR__.'/../../library/db/Connect.class.php');
class Categories
{

    private $db;
    private $language;
    private $categories;
    /**
     * Categories constructor.
     */
    public function __construct($language=LANGUAGE_DEFAULT)
    {
        $this->language = $language;
        $this->db = new Connect(Connect::DBSERVER);
        $query = "SELECT 
                        a.category_id, COALESCE(b.translation, a.name) as name, c.total
                    FROM
                        booksharing.category a
                            LEFT JOIN
                        booksharing.dictionary b ON a.category_id = b.id
							AND b.table = 'category'
                            AND language = '".$language."'
						LEFT JOIN (
							SELECT category_id, count(book_id) AS total FROM
							booksharing.book 
							WHERE status in ('".BOOK_STATUS_RESERVED."','".BOOK_STATUS_BORROWED."',
							'".BOOK_STATUS_AVAILABLE."')
							GROUP by category_id                                
						) c ON a.category_id = c.category_id;";

        $this->categories = $this->db->selectArray($query,["index"=>"category_id"]);
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    public function getCategoryById($categoryId)
    {
        return isset($this->categories[$categoryId])?$this->categories[$categoryId]:null;
    }

    public function toJSON(){
        return json_encode([
            'data'=>array_values($this->categories),
            'stats'=>['total'=>count($this->categories)],
            'page'=>1,
        ],JSON_UNESCAPED_UNICODE );
    }
}