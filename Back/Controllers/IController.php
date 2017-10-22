<?php

require_once "\\..\\Models\DirectorModel.php";
// the controller will maintain the logic of the model, 
// Implements CRUD opeartions for all controllers that will inherit

class IController 
{
    private $tblName;
    private $modelClassName ;
    private $dbHandler;
      
    public function __construct( $dbHandler, $tblName, $modelClassName  )
    {     
        if(( $dbHandler )&&( $tblName ))
        {
            $this->dbHandler = $dbHandler;
            $this->tblName = strtolower($tblName);
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

    public function Create( $modelObj) //Insert
    {
        //$model = $modelObj->jsonSerialize(); 
        $keyStr = "(";
        $valueStr = " VALUES(";
        
        
       
        // if( !is_array($modelObj))
        // {
        //     $modelObj =  (array) $modelObj;
        // }

        foreach( $modelObj as $key => $value ) 
        {
            $keyStr .= $key . ", ";
            $valueStr .= "'" . $value . "',";    
        }

        $keyStr = rtrim($keyStr,", ") . ")" ;
        $valueStr = rtrim( $valueStr, ", ") . ")" ;
        

        $sqlQuery = "INSERT INTO " . $this->tblName . $keyStr . $valueStr .";";

        $result = $this->dbHandler->runQuery( $sqlQuery );

        if($result)
        {
            return  $result;
        }
        else
        {
            return null;
        }
    
        
    }


    public function Read( $paramArr )
    {
        if( (count($paramArr)==0) || ( array_key_exists("id", $paramArr)==false))
        {
            return $this->getAll() ;
        }

        try
        {
            $sqlQuery = "SELECT * FROM " . $this->tblName . " WHERE `" . $this->tblName ."`.`id` = " . $paramArr["id"].";";
            $statement = $this->dbHandler->runQuery( $sqlQuery );

            if(  $statement )
            {                
                $allObjArr = $statement->fetchAll( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->modelClassName , array('id', 'name'));
                return $allObjArr;
                // $tmp = $allObjArr[0]->jsonSerialize() ;
                // return json_encode( $tmp);
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
    
    public function getAll() 
    {
        try
        {
            $statement = $this->dbHandler->runQuery( "SELECT * FROM " . $this->tblName );
            if(  $statement )
            {   
              //  return  $statement;             
                 $allObjArr = $statement->fetchAll( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , $this->modelClassName );
                 return $allObjArr;
            }
            else
            {
                Notify("No data returned from GetAll, tabls name:  " . $this->tblName );
                return null;
            }

        }
        catch(PDOException  $e )
        {
            notify::Error( $e->getMessage() );
            Die(); //TODO: Restart app
        }
    }

    


    public function Update( $modelObj )
    {
        $sqlQuery = "UPDATE `" . $this->tblName . "` SET ";

        $model = $modelObj->jsonSerialize(); 

        foreach( $model as $key => $value ) 
        {
            if( $key != "id")
                $sqlQuery .= "`". $key . "` = '" . $value . "',";    
        }

        $sqlQuery =substr($sqlQuery, 0 , strlen( $sqlQuery )-1 ) ;
        $sqlQuery .= " WHERE `" . $this->tblName ."`.`id` = " . $model["id"].";";

        if ( $GLOBALS['debugMode'] == true)
        {
            echo   $sqlQuery ;
            //die();
        }
        $result = $this->dbHandler->runQuery( $sqlQuery );

        if($result)
        {
            if ( $GLOBALS['debugMode'] == true)
                echo "Update succeed!";
        }
    
        return $result;
    }

    public function Delete( $id )
    {
        $sqlQuery = "DELETE FROM `" . $this->tblName . "` WHERE `" . $this->tblName ."`.`id` = " . $id.";";
        
        $result = $this->dbHandler->runQuery( $sqlQuery );
        
        // if($result)
        // {
        //     if ( $GLOBALS['debugMode'] == true)
        //         echo "Delete succeed!";
        // }
    
        // return $result;

    }

}


?>