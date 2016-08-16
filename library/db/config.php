<?php
/**
 * Created by PhpStorm.
 * User: wkurn
 * Date: 05.11.2015
 * Time: 12:21
 */


define("DBSERVER","DBSERVER");

function getConnectionInfo(){
    $dbConnectionInfo = array(
        DBSERVER => array( 'host'=>'bodyandmindfitness.de',
            'user'=>'immanuel',
            'password'=>'',
            'name'=>'booksharing')
    );
    return $dbConnectionInfo;
}

