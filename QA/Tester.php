<?php

require_once '../DAL/Connection.php';
require_once '../Server/Director/DirectorController.php';



$dbHanler = new Connection( "movies_project" );

$directorCtrl = new DirectorController( $dbHanler );

$allDirectorsArr = $directorCtrl->getAll();

var_dump( $allDirectorsArr );




?>