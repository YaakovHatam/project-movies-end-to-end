<?php

include_once "IModel.php";



class DirectorModel extends IModel
{
    private $id;
    private $name;

    public function __construct(  $id=0, $name="" )
    {
        $this->id = $id;
        $this->name = $name;  
    }

    public function jsonSerialize() 
    {
        return  ["id" => $this->id,
                 "name" => $this->name ];
    }

    public function getId( )
    {
        return $this->id;
    }

    public function getName(  )
    {
        return $this->name;
    }

    public function setId( $id )
    {
        $this->id = $id;
    }

    public function setName( $name )
    {
        $this->name = $name;
    }
}

?>