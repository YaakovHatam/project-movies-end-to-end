<?php

require_once 'directorApi.php';
require_once 'movieApi.php';


$requestMethod = $_SERVER['REQUEST_METHOD']; 
$apiObj;

if($_SERVER['REQUEST_METHOD'] == 'PUT' || $_SERVER['REQUEST_METHOD'] == 'DELETE') 
{
    parse_str( file_get_contents("php://input"), $post_vars );
    
    $params = $post_vars['params']; 
}
else
{
    $params = $_REQUEST['params'];
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
$result  = $apiObj->handleClientRequests( $requestMethod, $params );
echo json_encode($result);


?>