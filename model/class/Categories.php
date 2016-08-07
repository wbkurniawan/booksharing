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
                        category_id, COALESCE(b.translation, a.name) as name
                    FROM
                        booksharing.category a
                            LEFT JOIN
                        booksharing.dictionary b ON a.category_id = b.id
                            AND b.table = 'category'
                            AND language = '".$language."'";
        $this->categories = $this->db->selectArray($query,["index"=>"category_id"]);
        foreach ($this->categories as $index => $category){
            $this->categories[$index] = array_map("utf8_encode",$category);
        }
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