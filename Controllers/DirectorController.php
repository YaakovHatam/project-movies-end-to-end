<?php

require_once "IController.php";

// the controller maintains the logic of the model (CRUD opeartions for example)

class DirectorController extends IController
{
    private $directorObj; 
      
    public function __construct( $dbHandler, $directorObj=null )
    {
        parent::__construct( $dbHandler, "Directors", "Director" );
        $this->directorObj = $directorObj;
    }
}


?>