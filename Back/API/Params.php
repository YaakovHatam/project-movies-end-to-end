<?php

/* This class will parse the PUT/DELETE params 
   and support GET/POST as well.  */

class Params 
{
    private $params = Array();

    public function __construct() 
    {
        $this->_parseParams();
    }

  /**
    * @brief Lookup request params
    * @param string $name - Name of the argument to lookup
    * @param mixed $default - Default value to return if argument is missing
    * @returns The value from the GET/POST/PUT/DELETE value, or $default if not set
    */
    
    public function getParam($name, $default = null) 
    {
        if( isset( $this->params[$name]) ) 
        {
            return $this->params[$name];
        }else
        {
            return $default;
        }
    }

    public function isEmpty( $name)
    {
        if(isset($this->params[$name]) )
        {
            $b = $this->params[$name]==null;
            $a = $this->params[$name]=="{}";
            $c =true;
            if(is_array($this->params[$name]))
            {
                $c =(count ($this->params[$name])==0);
            }
            return ($a||$b||$c);
        }
        return false;
        
    }

    public function unsetParam($name)
    {
        unset($this->params[$name]);
        $a = $this->params;
    }

    public function getParams()
    {
        return $this->params;
    }

    private function _parseParams() 
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if( $method == "PUT" || $method == "DELETE") 
        {
            parse_str( file_get_contents('php://input'), $this->params );
            $GLOBALS["_{$method}"] = $this->params;
            /* Add these request vars into _REQUEST, mimicing default behavior, 
               PUT/DELETE will override existing COOKIE/GET vars*/
            $_REQUEST = $this->params + $_REQUEST;
        } 
        else if( $method == "GET") 
        {
            $this->params = $_GET;
        } 
        else if( $method == "POST") 
        {
            $this->params = $_POST['params'];
            $this->params = $_REQUEST['params'];
        }
    }
}
?>