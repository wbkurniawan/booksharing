<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


include_once(__DIR__.'/../config/global.php');
include_once(__DIR__.'/../model/class/Books.php');

$app = new Silex\Application();
$app['debug'] = true;

$app->get('/categories', function (){
    $response = new Response();
    $response->headers->set('Content-Type','application/json;charset=utf-8');

    if ( !isset($_SESSION) ) session_start();

    $result = "";
    if(!isset($_SESSION["categories"])){
        $cat = new Categories();
        $catJSON = $cat->toJSON();
        $_SESSION["categories"] = $catJSON;
        $result = $catJSON;
    }else{
        $result = $_SESSION["categories"];
    }
    $response->setContent($result);
    return $response;
});

$app->get('/books/{id}', function ($id) use($app) {
    $response = new Response();
    $response->headers->set('Content-Type','application/json;charset=utf-8');

    $book = new Books();
    $book->setInJson();
    $result = $book->getBookById($id);
    $response->setContent($result);
    return $response;
});

$app->get('/books', function (Request $request) use ($app) {
    $response = new Response();
    $response->headers->set('Content-Type','application/json;charset=utf-8');

    $book = new Books();
    $book->setInJson();

    $search = $request->get('search');
    if(isset($search)){
        $result = $book->search($search,1,BOOKS_VIEW_LIMIT_LIST);
        $response->setContent($result);
        return $response;
    }

    $categoryId = $request->get('categoryId');
    if(isset($categoryId)){
        $result = $book->getBooksByCategory($categoryId,1,BOOKS_VIEW_LIMIT_LIST);
        $response->setContent($result);
        return $response;
    }

    $userId = $request->get('userId');
    if(isset($userId)){
        $result = $book->getBooksByOwner($userId,1,BOOKS_VIEW_LIMIT_LIST);
        $response->setContent($result);
        return $response;
    }

    $recommended = $request->get('recommended');
    if(isset($recommended)){
        $result = $book->getBooksRecomended();
        $response->setContent($result);
        return $response;
    }

    $isLatest = $request->get('latest');
    if(isset($isLatest)){
        $result = $book->getBooksLatest();
        $response->setContent($result);
        return $response;
    }

    $isPersonal = $request->get('personal');
    if(isset($isPersonal)){
        $result = $book->getBooksPersonalRecommendation();
        $response->setContent($result);
        return $response;
    }

    $page = $request->get('page');
    if(isset($page)){
        $result = $book->getBooksByPage($page);
        $response->setContent($result);
        return $response;
    }

    $app->abort(404, "invalid parameter");
});

$app->run();
