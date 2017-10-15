$( document ).ready(function() 
{
    CRUD.Read(); 
         
    $('#btnCreate').click(function(e) 
    {
        e.preventDefault(); 
        CRUD.Create(); 
        $('#create').modal('hide');
    
    });
    
});



/*
class Rectangle {
  constructor(height, width) {
    this.height = height;
    this.width = width;
  }
  
  getArea() {
    return this.calcArea();
  }

  calcArea() {
    return this.height * this.width;
  }
}

const square = new Rectangle(10, 10);

console.log(square.getArea()); // 100
*/
/*
Parent = (function () {
    // constructor
    function construct () {
        console.log("Parent");
    };

    // public functions
    construct.prototype.test = function () {
        console.log("test parent");
    };
    construct.prototype.test2 = function () {
        console.log("test2 parent");
    };

    return construct;
})();


Child = (function () {
    // constructor
    function construct() {
        console.log("Child");
        Parent.apply(this, arguments);
    }

    // make the prototype object inherit from the Parent's one
    construct.prototype = Object.create(Parent.prototype);
    // public functions
    construct.prototype.test = function() {
        console.log("test Child");
    };

    return construct;
})();
*/



// jquery ajax implementation Module of CRUD operations
var CRUD = (function() 
{
    function Create() 
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
    }

    function Read(objType)//viewData
    {
        $.ajax({
            type: "GET",
            url: App.getServerUrl() ,
            data: 
            { 
                objType: objType
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

    }

    function Update(id)
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
    }

    function Delete(id)
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

    }

    return {    
        Create: Create,
        Read :Read ,
        Update: Update, 
        Delete: Delete    
    };

}()); // end of CRUD closure

