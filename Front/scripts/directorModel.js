"use strict";

let DirectorController = modelController.loadController({
    
                                            name: {htmlId: 'name' , val: '' },
                                            email: {htmlId: 'email' , val: '' },
                                            phone: {htmlId: 'phone' , val: '' },
                                            adress: {htmlId: 'address' , val: '' }
                                          });
/*
var DirectorModel = (function(theName, theId=0){
    var id = theId;
    var name = theName;

    function get()
    {
        return { id: id, name: name };
    }

    function getId()
    {
        return id;
    }

    function getName()
    {
        return name;
    }

    return {
        get :get,
        getId: getId,
        getName: getName
    };
}());*/