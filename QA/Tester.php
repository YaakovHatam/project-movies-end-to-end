<?php

require_once '..\\DAL\Connection.php';
require_once '..\\Controllers\DirectorController.php';

$dbHanler = new Connection( "movies_project" );
/* 
$directorCtrl = new DirectorController( $dbHanler );

$allDirectorsArr = $directorCtrl->getAll();

var_dump( $allDirectorsArr );

TEST Succeed!: directorCtrl->getAll(). 
-----------------------------------------
*/

/*
$testDir = new DirectorModel("Yosef") ;
//print_r( $testDir->jsonSerialize() );

$dirCtrl = new DirectorController( $dbHanler, $testDir );

$succeed = $dirCtrl->Create( $testDir );
echo $succeed;
TEST Succeed!: directorCtrl->Create(). 
-----------------------------------------
*/
/*
$testDir = new DirectorModel("Yosef3",5) ;
$dirCtrl = new DirectorController( $dbHanler, $testDir );
$succeed = $dirCtrl->Update( $testDir );

*/

$dirCtrl = new DirectorController( $dbHanler );

$succeed = $dirCtrl->Delete( 7 );
?>