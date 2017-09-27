<?php

// To be extended as a specific API of each model / Controller 
    abstract class Api 
    {
        // private $dbHandler;

        abstract function Create( $params );
        abstract function Read( $params );
        abstract function Update( $params );
        abstract function Delete( $params );

        // protected function getdbHandler()
        // {
        //     return $this->dbHandler;
        // }

        // protected function setdbHandler( $dbHandler )
        // {
        //     $this->dbHandler = $dbHandler;
        // }


        public function handleClientRequests(  $method, $params ) 
        {
            // $this->setdbHandler( $dbHandler );

            switch ( $method ) 
            {
                case "POST":
                    return $this->Create( $params );

                case "GET":
                    return  $this->Read( $params );

                case "PUT":
                    return $this->Update( $params );

                case "DELETE":
                    return $this->Delete( $params );

                    default:
                    break;
            }
        }
    }
?>