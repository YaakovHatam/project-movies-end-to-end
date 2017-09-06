<?php

//include_once "../BaseClass/IModel.php";
include_once "IModel.php";


class Director extends IModel
{
    public function __construct( $id, $name )
    {                    //['property' => 'Here we go']
        $model = (object)['id' => $id, 'name'=> $name ];

        $this->setModel( object( $model ) );
    }

   

    
}

?>