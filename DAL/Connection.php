<?php

require_once "../Error/Notify.php";

$debugMode = true;


class Connection
{
    private $host;
    private $dbName;
    private $user;
    private $password;
    private $charset;
    private $opt; //A key=>value array of driver-specific connection options.
    private $dbConnection; //pdo
    private $dsn; /*The Data Source Name, or DSN, contains the information required to connect to the database.*/
     

    public function __construct( $dbName ,
                                 $user = 'root',
                                 $password = '',
                                 $host = '127.0.0.1',
                                 $charset = 'utf8',
                                 $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                                         PDO::ATTR_EMULATE_PREPARES   => false]
                                )
    {
        $this->host    = $host;
        $this->dbName  = $dbName;
        $this->user    = $user;
        $this->password= $password;
        $this->charset = $charset;
        $this->opt     = $opt;
        
    
        $this->dsn = "mysql:host=" . $host . ";dbname=" . $dbName . ";charset=" . $charset;
        
        if( ! $this->connect() ) // db doesnt exist
        {
            $this->dbConnection = $this->createDb();       
        }
    }

    private function createDb()
    {
       

    }

    private function connect()
    {
        try{

            $this->dbConnection = new PDO( $this->dsn, $this->user, $this->password, $this->opt );
            return $this->dbConnection;
            
        }catch( PDOException $e) {

            Notify::error( 'Connection failed:  exception was thrown: ' . $e->getMessage() );
            return null;
        }
        
    }

    public function getDbConnection()
    {
        if( $this->dbConnection == null)
        {
            $this->connect();
        }

        return $this->dbConnection;
    }

    public function runQuery( $sqlQuery, $arrParams=null )
    {
        try
        {
            $statement = $this->getDbConnection()->prepare( $sqlQuery );
            
            if(  ! $statement->execute($arrParams) )
            {
                Notify::error( 'pdo->prepare->execute failed' );
                return NULL;
            }
            return $statement;
            
        }catch( PDOException $e) 
        {
            Notify::error( 'pdo->prepare->execute failed:  exception was thrown: ' . $e->getMessage() );
        }
    }
}




?>
