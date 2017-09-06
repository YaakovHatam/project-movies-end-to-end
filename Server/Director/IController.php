<?php

require_once "Director.php";
// the controller will maintain the logic of the model, 
// the CRUD opeartions for example.

class IController
{
    private $tblName;
    private $modelClassName ;
      
    public function __construct( $dbHandler, $tblName, $modelClassName  )
    {     
        if(( $dbHandler )&&( $tblName ))
        {
            $this->dbHandler = $dbHandler;
            $this->tblName = $tblName;
            $this->modelClassName = $modelClassName ;

        }
        else
        {
            // TODO:?? get from DI Injector
            $errorMsg = "Controller __construct got a faulty dbHandler: " . dbHandler . "or table name: " . $tblName;
            Notify::log( $errorMsg );
            throw new Exception( $errorMsg );
        }      
    }

    public function getAll( ) 
    {
        try
        {
            $statement = $this->dbHandler->runQuery( "SELECT * FROM " . $this->tblName );
            if(  $statement )
            {                
                $allObjArr = $statement->fetchAll( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->modelClassName );
                return $allObjArr;
            }
            else
            {
                Notify("No data returned from GetAll, tabls name:  " . $this->tblName );

            }

        }
        catch(PDOException  $e )
        {
            notify::Error( $e->getMessage() );
            Die(); //TODO: Restart app
        }
    }

    public function Create( $query )
    {

    }

    public function Read()
    {

    }

    

    public function Update()
    {

    }

    public function Delete()
    {

    }



   
/*
    public function insert( $tblName, $obj) 
    {
        $keyStr = "(";
        $valueStr = " VALUES(";
        
        foreach( $obj as $key => $value ) 
        {
            $keyStr .= $key . ", ";
            $valueStr .= "'" . $value . "',";    
        }

        $keyStr = rtrim($keyStr,", ") . ")" ;
        $valueStr = rtrim( $valueStr, ", ") . ")" ;
        

        $sqlQuery = "INSERT INTO " . $tblName . $keyStr . $valueStr .";";

        return $this->dbHandlerr->runQuery( $sqlQuery );
    }*/
}


?>