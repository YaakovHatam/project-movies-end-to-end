<?php

require_once '..\\Back\Common\Connection.php';
require_once '..\\Back\Controllers\DirectorController.php';

$dbHanler = new Connection( "movies_project" );
/* TEST 1
TEST Succeed!: directorCtrl->getAll(). 
-----------------------------------------
*/
$directorCtrl = new DirectorController( $dbHanler );

$allDirectorsArr = $directorCtrl->getAll();
echo "</br>TEST 1: ";
var_dump( $allDirectorsArr );



/*TEST 2
TEST Succeed!: directorCtrl->Create(). 
-----------------------------------------
*/
$testDir = new DirectorModel("Yosef") ;
echo "</br>TEST 2: ";
print_r( $testDir->jsonSerialize() );

$dirCtrl = new DirectorController( $dbHanler, $testDir );

$succeed = $dirCtrl->Create( $testDir );
if( $succeed != null)
    echo "Create scuceed";
else
    echo "Create failed";

/*TEST 3*/
$testDir = new DirectorModel("Yosef3",5) ;
$dirCtrl = new DirectorController( $dbHanler, $testDir );
$succeed = $dirCtrl->Update( $testDir );
echo "</br>TEST 3: ";
if( $succeed != null)
    echo "Update scuceed";
else
    echo "Update failed";

/*TEST 4*/
echo "</br>TEST 4: ";
$dirCtrl = new DirectorController( $dbHanler );
$succeed = $dirCtrl->Delete( 7 );

if( $succeed != null)
    echo "Delete scuceed";
else
    echo "Delete failed";

?>