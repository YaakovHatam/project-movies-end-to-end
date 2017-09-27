<?php

require_once "IController.php";



class MovieController extends IController
{
    private $movieObj; 
      
    public function __construct( $dbHandler, $movieObj=null )
    {
        parent::__construct( $dbHandler, "Movies", "MovieModel" );
        $this->movieObj = $movieObj;
    }
}


?>