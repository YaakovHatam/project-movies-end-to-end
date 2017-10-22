<?php
set_include_path('.;C:\xampp\htdocs\MICHAL-PHP\new-‏‏end-to-end-movies-project');
require_once 'directorApi.php';
require_once 'movieApi.php';
require_once 'Params.php';

$requestMethod = $_SERVER['REQUEST_METHOD']; 
$apiObj;

$sentParams = new Params();
$params = $sentParams->getParams();
//var_dump($params);


if($params['params']=="")
{
    $params['params'] = array();
}

$objType = $_REQUEST['objectType'];

switch ($objType) {
    
        case 'director':
            $apiObj = new DirectorApi();
            break;

        case 'movie':
            $apiObj = new MoviesApi();
            break;
}

// $dbHandler = new Connection( "movies_project" ); /* sending dbHandle from outside 
//                                                    acording to DI rules*/

//unset($params['objectType']);

$result  = $apiObj->handleClientRequests( $requestMethod, json_decode($params['params'] ));
//var_dump( $result);
// $result  = json_encode($result);
// $utf = array_map(function($r) 
// {
//     $r->setName( utf8_encode( $r->getName()) );
//     return $r;
// }, $result);
// var_dump( $utf);
echo  json_encode($result);
// $e = json_last_error_msg ( );
// var_dump( $e);

?>