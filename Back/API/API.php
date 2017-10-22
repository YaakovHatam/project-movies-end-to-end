<?php
set_include_path('.;C:\xampp\htdocs\MICHAL-PHP\new-‏‏end-to-end-movies-project');
require_once 'directorApi.php';
require_once 'movieApi.php';
require_once 'Params.php';

$requestMethod = $_SERVER['REQUEST_METHOD']; 
$apiObj;

$sentParams = new Params();

$objType = $sentParams->getParam('objectType');//$_REQUEST['objectType'];
$sentParams->unsetParam('objectType');

if($sentParams->isEmpty('params'))
{
    $params['params'] = array();
}
else
{
    $params = $sentParams->getParam('params');
}



switch ($objType) {
    
        case 'director':
            $apiObj = new DirectorApi();
            break;

        case 'movie':
            $apiObj = new MoviesApi();
            break;
}




$result  = $apiObj->handleClientRequests( $requestMethod, $params);//json_decode($params)
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