<?php

abstract class IModel
{
    private $model;

    protected function setModel( $modelObj )
    {
        $this->model = $modelObj;
    }

    public function getModel()
    {
        return $this->model;
    }

     /*Returns an array of model keys
    */

    public function getModelKeys() 
    {
        return get_object_vars( $this->getModel() );
    }
    
}


?>