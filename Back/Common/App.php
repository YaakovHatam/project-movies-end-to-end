<?php

class App
{
    private $dbName;

    public function __construct($dbName = 'movies_project')
    {
        $this->dbName = $dbName;

    }

    public function getDbName()
    {
        return  $this->dbName;
    }
}

?>