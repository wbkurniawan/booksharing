<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/20/2016
 * Time: 5:10 PM
 */

include_once(__DIR__.'/../model/class/UserSession.php');
include_once(__DIR__.'/../model/class/Books.php');
include_once(__DIR__.'/../library/db/Connect.class.php');
include_once(__DIR__.'/../lock.php');
include_once(__DIR__.'/../library/image.class.php');
//header('Content-type: application/json');

if(!isset($_SESSION["user"])){
    $response = array('error' => true,
        'error_message' => 'user not logged in',
        'error_code' => 403);
    echo json_encode($response);
    die();
}

$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;

$bookId = isset($_POST["bookId"])?(integer)$_POST["bookId"]:0;
if($bookId===0){
    $response = array('error' => true,
        'error_message' => "Bad request. Parameter mismatch or missing",
        'error_code' => 400);
    echo json_encode($response);
    die();
}

try {

    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['upfile']['error']) ||
        is_array($_FILES['upfile']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here.
    if ($_FILES['upfile']['size'] > 2000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
            $finfo->file($_FILES['upfile']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),
            true
        )) {
        throw new RuntimeException('Invalid file format.');
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    $fileName = sha1_file($_FILES['upfile']['tmp_name']).".".$ext;
    $destination =  sprintf(__DIR__.'/../assets/img/book/%s',$fileName);
    if (!move_uploaded_file($_FILES['upfile']['tmp_name'],$destination)) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

    $book = new Books($bookId);
    $book->setImage($fileName);
    $book->saveProperties();

    $img = new image;

    // initialize
    $img->max_x        = 100;
    $img->max_y        = 100;
    $img->cut_x        = 0;
    $img->cut_y        = 0;
    $img->quality      = 100;
    $img->save_to_file = true;
    $img->image_type   = -1;

    // generate thumbnail
    $img->GenerateThumbFile(__DIR__."/../assets/img/book/".$fileName, __DIR__."/../assets/img/book/s_".$fileName);

    header("Location: /booksharing/edit.php?id=".$bookId);

} catch (RuntimeException $e) {

    echo $e->getMessage();

}