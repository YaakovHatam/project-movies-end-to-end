<?php

include_once "IModel.php";



class DirectorModel extends IModel
{
    private $id;
    private $name;

    public function __construct(  $name, $id=null )
    {
        $this->id = $id;
        $this->name = $name;

        parent::__construct( [  "id" => $this->id,
                                "name" => $this->name ] );
    }

    public function getId( $id )
    {
        return $this->id;
    }

    public function getName( $name )
    {
        return $this->name;
    }
}

?>