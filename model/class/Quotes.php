<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 10/8/2016
 * Time: 8:49 AM
 */


include_once(__DIR__.'/../../library/db/Connect.class.php');
class Quotes
{

    public static function getQuotes(){
        $db = new Connect(Connect::DBSERVER);
        $query = "SELECT content,`source` FROM booksharing.quotes ORDER BY RAND() LIMIT 0,1;";
        $rows = $db->selectArray($query);
        if(count($rows)>0){
            return json_encode(["content"=>$rows[0]["content"],
                                "source"=>$rows[0]["source"]],JSON_UNESCAPED_UNICODE );
        }else{
            return null;
        }
    }

}