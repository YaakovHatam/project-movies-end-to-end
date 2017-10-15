$( document ).ready(function() 
{
    let dirCrud =  DirectorsCrud(); 
    dirCrud.Read(); 
         
    $('#btnCreate').click(function(e) 
    {
        e.preventDefault(); 
        DirectorsCrud.Create(); 
        $('#create').modal('hide');
    
    });
    
});



// jquery ajax implementation Module of CRUD operations
Crud = (function() 
{
    // constructor
    function construct ( objType ) 
    {
        this.objType = objType;
    };

    construct.prototype.Create = function () 
    {
        $.ajax({
            type: "POST",
            url: App.getServerUrl() + '?p=create',
            data: DirectorController.loadInputs('create'),
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
    };

    construct.prototype.Read = function()//viewData
    {
        $.ajax({
            type: "GET",
            url: App.getServerUrl() ,
            data: 
            { 
                objType: this.objType
            },
            success: function(response)
            {
                //View.show('tbody',response) BUG: not working
                $('tbody').html(response);   
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(jqXHR+textStatus+errorThrown);
            }   
        }); //end of $.ajax

    };

    construct.prototype.Update = function (id)
    {
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
    };

    construct.prototype.Delete = function (id)
    {
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

    };

    return construct;

})(); // end of CRUD module

MoviesCrud = (function () {
    // constructor
    function construct() 
    {    
        Crud.apply(this, "movie");
    }

    // make the prototype object inherit from the Parent's one
    construct.prototype = Object.create(Crud.prototype);
    
    return construct;
})();

DirectorsCrud = (function () {
    // constructor
    function construct() 
    {    
        Crud.apply(this, "director");
    }

    // make the prototype object inherit from the Parent's one
    construct.prototype = Object.create(Crud.prototype);
    
    return construct;
})();