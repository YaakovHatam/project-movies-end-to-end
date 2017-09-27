<?php

class MovieModel extends IModel
{

    private $id;
    private $name;
    private $d_id; 

    public function __construct(  $name, $d_id, $id=null )
    {
        $this->id = $id;
        $this->name = $name;
        $this->d_id = $d_id ;

        parent::__construct( [  "id" => $this->id,
                                "name" => $this->name,
                                "d_id" => $this->d_id ] );
    }
}

?>