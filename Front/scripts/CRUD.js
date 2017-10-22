$( document ).ready(function() 
{
    CRUD.Read("director"); 
         
    $('#btnCreate').click(function(e) 
    {
        e.preventDefault(); 
        CRUD.Create("director"); 
        $('#create').modal('hide');
    });
});



// jquery ajax implementation Module of CRUD operations
var CRUD = (function() 
{
    function getObjType()
    {
        return crudObjType = $('table').attr('id');
    }
    

    function Create() 
    {
       // add all inputs into FormData object
        // var formData = new FormData();
        // formData.append('objectType', getObjType());
        // formData.append('params', { name: DirectorController.loadInputs('create')});
        
        let params = DirectorController.loadInputs('create');

        // var my_json_obj;
        
        // $.each(params, function(key,value){
        //     my_json_obj[key]=value;
        // });
        

        $.ajax({
            type: "POST",
            url: App.getServerUrl(),
            //data:   formData,
            dataType: 'json',
            data: 
            { 
                //objectType: getObjType(),
                params: {objectType:"director", params:{name: "john"}}//params//JSON.stringify(params)
            }, 
            success: function(response)
            {
                Read(); 
                View.notifySuccess("Create succeed")
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                
                View.alertError( errorThrown);
            }   
            }).done(function(response)
            {
              //  View.notifySuccess("Create succeed")
            });
    }

    function Read(crudObjType)
    {
        $.ajax({
            type: "GET",
            url: App.getServerUrl() ,
            dataType: 'json',
            data: 
            { 
                //params: {objectType:"director"}
                objectType:"director"
            },
            success: function(returnedData)
            {

                View.createTblBody( returnedData );
                //View.notifySuccess("Read succeed")
                
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                View.alertError( errorThrown);
            }   
        }); //end of $.ajax

    }

    function Update(id, clickedB)
    {
        let params = DirectorController.loadInputs('update',id);
        $.ajax({
            type: "PUT",
            url: App.getServerUrl(),
            dataType: 'json',
            data: 
            { 
                objectType: getObjType(),
                params: params
            }, 
            async: false,
            success: function(response)
            {
                Read(); 
                View.notifySuccess("Update succeed")
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                View.alertError( errorThrown);
                
            }   
            });
//}); //end of $.ajax
    }

    function Delete(id)
    {
        let param=[];
        param['id'] = id;

        let params=[] ;
        params['params'] = param;
        
        $.ajax({
            type: "DELETE",
            url: App.getServerUrl(),
            dataType: 'json',
            data: 
            { 
               // objectType: getObjType(),
                params : params
            },
            async: false,
            success: function(response)
            {
                Read(); 
                View.notifySuccess("Delete succeed")
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                View.alertError( errorThrown);
                
            }   
        }); //end of $.ajax

    }

    return {    
        Create: Create,
        Read :Read ,
        Update: Update, 
        Delete: Delete    
    };

}()); // end of CRUD closure

