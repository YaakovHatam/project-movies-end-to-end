<?php

require_once "\\..\\Models\DirectorModel.php";
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

    /*
    public function Read()
    {

    }
    */
    public function getAll( ) 
    {
        try
        {
            $statement = $this->dbHandler->runQuery( "SELECT * FROM " . $this->tblName );
            if(  $statement )
            {                
                $allObjArr = $statement->fetchAll( PDO::FETCH_CLASS , $this->modelClassName );
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

    public function Create( $modelObj) //Insert
    {
        $model = $modelObj.jsonSerialize(); 
        $keyStr = "(";
        $valueStr = " VALUES(";
        
        foreach( $model as $key => $value ) 
        {
            $keyStr .= $key . ", ";
            $valueStr .= "'" . $value . "',";    
        }

        $keyStr = rtrim($keyStr,", ") . ")" ;
        $valueStr = rtrim( $valueStr, ", ") . ")" ;
        

        $sqlQuery = "INSERT INTO " . $this->tblName . $keyStr . $valueStr .";";

        return $this->dbHandlerr->runQuery( $sqlQuery );
    }

   

    

    

    public function Update()
    {

    }

    public function Delete()
    {

    }

}


?>