<?php

class MovieModel{

    private $id;
    private $name;
    private $d_id; 

    public function __construct( $id, $name, $d_id )
    {
        $this->id = $id;
        $this->name = $name;
        $this->d_id = $d_id ;
    }
}

?>