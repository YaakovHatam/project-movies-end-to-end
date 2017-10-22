"use strict";

/* Base Model module for all objects to be used generic in CRUD operations */

const modelController = (function() 
{
    var modelDataArr;
    
    function loadInputs( crudOpt, id=0 )
    {
        let jsonStr = '{';
        let inputArr = [];
        switch( crudOpt )
        {
            case 'create':
             {
                for(let key in modelDataArr) 
                {
                    if( key != 'id')
                    {
                        inputArr[key] =  $( '#'+modelDataArr[key].htmlId ).val();
                        //jsonStr += modelDataArr[key].htmlId + ' : "' + $( '#'+modelDataArr[key].htmlId ).val() + '",';
                    }
                }
                inputArr['objectType'] = getObjType();
                
                return inputArr; 

                // for(let key in modelDataArr) 
                // {
                //     if( key != 'id')
                //     {
                //         // concat key value json string
                //         jsonStr += modelDataArr[key].htmlId + ' : "' + $( '#'+modelDataArr[key].htmlId ).val() + '",';
                //     }
                // }
                // jsonStr = jsonStr.slice(0, -1);
                // jsonStr += '}';
                
                // return jsonStr; 
                // var my_json_obj = json_obj_1;
                
                // $.each(json_obj_2, function(key,value){
                //     my_json_obj[key]=value;
                // });
            }
            case 'update':
            {
                for(let key in modelDataArr) 
                {
                    if( key != 'id')
                    {
                        modelDataArr[key].val = $( '#' + modelDataArr[key].htmlId + "-" + id ).val();
                        jsonStr += modelDataArr[key].htmlId + '=' + modelDataArr[key].val + '&';
                        /*
                        id="updateLabel-`+ id
                        */
                    }
                }
                jsonStr = jsonStr.slice(0, -1);
                jsonStr += "&id="+id ;

                return jsonStr; 
            }
            default:
                View.alertError("error in modelController.loadInputs. unknown crudOpt");
                return null;
            
        } //end of switch( crudOpt )

    } //end of function loadInputs

    function getObjType()
    {
        return crudObjType = $('table').attr('id');
    }
    
    function get()
    {
        return modelData;
    }

    function loadController(keyHtmlIdValArr)
    {
        modelDataArr = keyHtmlIdValArr;
        return this;
    }

    return {    loadInputs: loadInputs,
                get :get ,
                loadController: loadController
            };

}()); // end of modelController