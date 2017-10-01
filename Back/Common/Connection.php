<?php

define('MY_DIR', 'michal-php\end-to-end-movies-project\\');

//require_once (MY_DIR.'Back\Error\Notify.php');


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
                                 $charset = 'utf8',//'utf8_general_ci',
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
        
        $this->connect(); 
        
            
    }

    private function connect()
    {
        try
        {
            if(!$this->dbConnection)
                $this->dbConnection = $this->createDb();       
           
            $this->dbConnection = new PDO( $this->dsn, $this->user, $this->password, $this->opt );

            return $this->dbConnection;
            
        }catch( PDOException $e) {

            Notify::error( 'Connection failed:  exception was thrown: ' . $e->getMessage() );
            return null;
        }
        
    }

    private function createDb()
    {
        try 
        {
            
            $dbh = new PDO( "mysql:host=$this->host", 
                            $this->user, 
                            $this->password, 
                            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="NO_AUTO_VALUE_ON_ZERO"',
                                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ) );
    
            $dbh->exec("CREATE DATABASE  IF NOT EXISTS `$this->dbName`  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
                    CREATE USER '$this->user'@'localhost' IDENTIFIED BY '$this->password';
                    GRANT ALL ON `$this->dbName`.* TO '$this->user'@'localhost';
                    FLUSH PRIVILEGES;") 
            or die(print_r($dbh->errorInfo(), true));
           
            // set db time zone           
            $offset = $this->getCurTimeZoneForMySql();
                     
            $dbh->exec("SET time_zone='$offset';");
                        
          
            // Create table directors

            $sqlCreateTbl = '
            CREATE table  IF NOT EXISTS `movies_project`.`directors`(
            id int(11) NOT NULL AUTO_INCREMENT,
            name varchar(50) NOT NULL,
            PRIMARY KEY (id)
            ) ENGINE=InnoDB';
            
    

            $dbh->exec($sqlCreateTbl);

            // Create table movies
          
            $sqlCreateTbl = '
            CREATE table  IF NOT EXISTS `movies_project`.`movies`(
            id int(11) NOT NULL AUTO_INCREMENT,
            name varchar(50) NOT NULL,
            d_id int(11) NOT NULL,
            PRIMARY KEY (id),
            CONSTRAINT movie_dir_id FOREIGN KEY (d_id)
            REFERENCES `movies_project`.`directors` (id)
            ) ENGINE=InnoDB';
                                                                                                                                                                                

            $dbh->exec($sqlCreateTbl);                                                                  

            /*
            INSERT INTO `directors` (`id`, `name`) VALUES
            (1, 'רמה בורשטין'),
            (2, 'גידי דר');
            
            
            INSERT INTO `movies` (`id`, `name`, `d_id`) VALUES
            (1, 'אושפיזין', 2),
            (2, 'לעבור את הקיר', 1);

            */
            
            
    
        } catch (PDOException $e) 
        {
            die("DB ERROR: ". $e->getMessage());
        }

    }

    private function getCurTimeZoneForMySql()
    {
        $now = new DateTime();
        $mins = $now->getOffset() / 60;
        $sgn = ($mins < 0 ? -1 : 1);
        $mins = abs($mins);
        $hrs = floor($mins / 60);
        $mins -= $hrs * 60;
        $offset = sprintf('%+d:%02d', $hrs*$sgn, $mins);
        return $offset;
    }

    

    public function getDbConnection()
    {
        if( $this->dbConnection == null)        
            $this->connect();
        

        return $this->dbConnection;
    }

    public function runQuery( $sqlQuery, $arrParams=null )
    {
        try
        {
            $statement = $this->getDbConnection()->prepare( $sqlQuery );
            
            if(  ! $statement->execute($arrParams) )
            {
                die(print_r('pdo->prepare->execute failed' , true));
                
            }
            return $statement;
            
        }catch( PDOException $e) 
        {
            die(print_r($this->dbConnection->errorInfo(), true));
            
        }
    }
}




?>
