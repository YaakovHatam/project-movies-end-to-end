<?php

abstract class IModel implements JsonSerializable 
{
    private $modelDataArr; 

    public function __construct( $modelKeyValueArr )
    {
        $this->setModel( $modelKeyValueArr );
    }

    protected function setModel( $modelDataArr )
    {
        $this->modelDataArr = $modelDataArr;
    }

    public function jsonSerialize() 
    {
        return $this->modelDataArr;
    }


}


?>