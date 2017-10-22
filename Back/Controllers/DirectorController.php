<?php
set_include_path('.;');//;C:\xampp\htdocs\MICHAL-PHP\new-‏‏end-to-end-movies-project;C:\xampp\php\PEAR;');

require_once "IController.php";
require_once "../Common/Connection.php";

class DirectorController extends IController
{
    private $directorObj; 
      
    public function __construct( $dbHandler=null, $directorParams=null/*$directorObj=null*/ )
    {
        if($dbHandler==null){
            $dbHandler = new Connection( "movies_project" );
        }
        parent::__construct( $dbHandler, "Directors", "DirectorModel" );
        $this->directorObj = $directorParams;
    }

    public function Read( $paramArr )
    {
        try
        {
            $allObjArr = parent::Read( $paramArr );
            
            return $allObjArr;
            

        }
        catch(PDOException  $e )
        {
            notify::Error( $e->getMessage() );
            Die(); //TODO: Restart app
        }

    }

    public function Delete( $paramArr )
    {
        try
        {
            $res = parent::Delete( $paramArr['id'] );
            
            return $res;
            

        }
        catch(PDOException  $e )
        {
            notify::Error( $e->getMessage() );
            Die(); //TODO: Restart app
        }

    }

    
}


?>