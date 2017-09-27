"use strict";
/*
var imported = document.createElement('script');
imported.src = 'directorController.js';
document.head.appendChild(imported);
*/
// keep selected object name (movie/director) in localStorage 

$('li').click( function(){ 
    let objName = this.closest('ul').id;
    if( objName != "") /*dont know why this func is beeing called twice 
                         even .unbind("click") didnt help*/
        window.localStorage.setItem("selectedObj", objName)
}); //$('li').click

$('#submit').click(function() {
    let name;
    let id=0;
    //let dirercotr_model = new DirectorModuleController();

    let clickedButton = $('#submit').val();
    let selectedObj = window.localStorage.getItem("selectedObj");
    let theObj;
        
    switch( clickedButton ) 
    {
        case 'get':
        {
            if($('#getAllOrById').val() == "getById")
                id = $('#idInput').val();
            theObj = new DirectorController();
            theObj.get(id);
            break;
        }
        /*
        case 'create':
            name = $('#name').val();
            dirercotr_model.createDirector(name);
            break;

    

        case 'update':
            id = $('#id').val();
            name = $('#name').val();
            dirercotr_model.UpdateDirectors(id, name);
            break;

        case 'delete':
            id = $('#id').val();
            dirercotr_model.deleteDirector(id);
            break;
*/

    }

}); // $('#submit').click(function


$('#getAllOrById').on('change',function(){
    if( $(this).val()==="getById"){
    $("#idInput").show()
    
    }
    else{
    
    }
}); // $('#getAllOrById').on('change',function





