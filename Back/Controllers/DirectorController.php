<?php
set_include_path('.;');//;C:\xampp\htdocs\MICHAL-PHP\new-‏‏end-to-end-movies-project;C:\xampp\php\PEAR;');

require_once "IController.php";
//require_once '..//Common/Connection.php';

// the controller maintains the logic of the model (CRUD opeartions for example)

class DirectorController extends IController
{
    private $directorObj; 
      
    public function __construct( $dbHandler=null, $directorObj=null )
    {
        if($dbHandler==null){
            $dbHandler = new Connection( "movies_project" );
        }
        parent::__construct( $dbHandler, "Directors", "DirectorModel" );
        $this->directorObj = $directorObj;
    }
}


?>