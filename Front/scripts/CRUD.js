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
var CRUD = (function( objType) 
{
    let crudObjType = objType;
    function Create() 
    {
        /*
        case "POST":
                    return $this->Create( $params );
        */
        $.ajax({
            type: "POST",
            url: App.getServerUrl(),// + '?p=create',
            //data: DirectorController.loadInputs('create'),
            data: 
            { 
                objectType: crudObjType,
                params: { //objectType: crudObjType, 
                          name: DirectorController.loadInputs('create')}
            },
            async: false,
            success: function(response)
            {
                Read(); 
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                View.alertError(textStatus)
            }   
            }).done(function(response)
            {
                View.notifySuccess("Create succeed")
            });
    }

    function Read(crudObjType)//viewData
    {
        /*
         case "GET":
                    return  $this->Read( $params );
        */
        $.ajax({
            type: "GET",
            url: App.getServerUrl() ,
            data: 
            { 
                objectType: crudObjType,
                params: null//new Array()
            },
            success: function(response)
            {
                //let arr = JSON.parse(response);
                View.addToTblBody( response );
                //$('tbody').html(response);   
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR+textStatus+errorThrown);
            }   
        }); //end of $.ajax

    }

    function Update(id)
    {
        /*
         case "PUT":
                    return $this->Update( $params );
        */
        $.ajax({
            type: "POST",
            url: App.getServerUrl() + '?p=update',
            data: DirectorController.loadInputs('update',id),
            async: false,
            success: function(response)
            {
                Read(); 
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR+textStatus+errorThrown);
                
            }   
            });
//}); //end of $.ajax
    }

    function Delete(id)
    {
        /*
case "DELETE":
    return $this->Delete( $params );
*/
        $.ajax({
            type: "GET",
            url: App.getServerUrl() + '?p=del',
            data: "id="+id,
            async: false,
            success: function(response)
            {
                Read(); 
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR+textStatus+errorThrown);
                //BUG HERE:$('#result').html("<br/><div class='alert alert-danger'>Error: "+textStatus+"</div>");
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

