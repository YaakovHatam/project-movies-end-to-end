"use strict";


var DirectorController = (function() /* closing this function with () keeps data 
                                        closure that will not be accessed from 
                                        outside this module.*/
{
    let apiUrl = '../../Back/API/API.php';
    let ajaxData = {
        objectType: 'director',
        params:{}
    };
    let ajaxObj = {
                    url: apiUrl ,
                    data: ajaxData,  
                    contentType: "application/json; charset=utf-8"
                    /*
                    data : JSON.stringify(data),
                    */
                    //dataType : "json",
                    
                }

    function get( /*callback,*/ id=0 ) //if not sending an id than == getAll
    {
        ajaxObj.type = 'GET';
        ajaxObj.success = function( returnedData ) 
        {
            alert("callback" +  returnedData);
            //callback( returnedData );
        };
        
        ajaxData.params.id = id;

        $.ajax( ajaxObj ); //$.ajax
       
    }

    function create( dataArr )
    {
     
    }

    return {
        create :create,
        get:get
    };
}); // var DirectorController = (function()


