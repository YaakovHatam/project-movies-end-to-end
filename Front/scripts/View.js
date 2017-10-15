// View closure ( the V of MVC )

const View = (function() 
{
    function addToTblBody( objArr)
    {
        let htmlTblStr='';

        for(i=0 ; i<objArr.length ; i++)
        {
            let id = objArr[i].id;

            htmlTblStr += `<tr><td>`+ id + `</td><td>`+ objArr[i].name + `</td>`;
            htmlTblStr += `<td><button class="btn btn-warning"  data-toggle="modal" data-target="#update-<?php echo $row['id']?>">Edit</button>`;
                    //Modal 
            htmlTblStr += `<div class="modal fade" id="update-`+ id + ` tabindex="-1" role="dialog" aria-labelledby="updateLabel-`+ id + `>`;
            htmlTblStr += `<div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="updateLabel-`+ id + `>Edit data</h4></div>`;
            htmlTblStr += `<form>
                                <div class="modal-body">
                                <input type="hidden" id=`+ id + ` value=`+ id + `>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name-`+ id + ` value=`+ id + `>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" onclick="CRUD.Update(`+ id +`)" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    <button onclick="CRUD.Delete(`+ id + `)" class="btn btn-danger">Delete</button>
                </td>
            </tr>`;
        }

        $('tbody').html(htmlTblStr); 
    }
    /*
    function doModal(heading, formContent) {
    html =  '<div id="dynamicModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal" aria-hidden="true">';
    html += '<div class="modal-dialog">';
    html += '<div class="modal-content">';
    html += '<div class="modal-header">';
    html += '<a class="close" data-dismiss="modal">×</a>';
    html += '<h4>'+heading+'</h4>'
    html += '</div>';
    html += '<div class="modal-body">';
    html += formContent;
    html += '</div>';
    html += '<div class="modal-footer">';
    html += '<span class="btn btn-primary" data-dismiss="modal">Close</span>';
    html += '</div>';  // content
    html += '</div>';  // dialog
    html += '</div>';  // footer
    html += '</div>';  // modalWindow
    $('body').append(html);
    $("#dynamicModal").modal();
    $("#dynamicModal").modal('show');

    $('#dynamicModal').on('hidden.bs.modal', function (e) {
        $(this).remove();
    });

}
    */

    function show( elemId, htmlStr ) 
    {
        // TODO: BUg doesnt work
        let selector = '#'+elemId;
        $(selector).html( htmlStr );
        
    }
    
    function alertError( text )
    {
        // TODO: BUg doesnt work
        //$('#result').html("<br/><div class='alert alert-danger'>Error: "+textStatus+"</div>");
    }   
        
    function notifySuccess( msg )
    {
        
        // TODO: BUg doesnt work
        
        let str = "<br/><div class='alert alert-info alert-dismissible'>"+msg+"</div>";
       
        $('#result').html(str);
        //document.getElementById('result').innerHTML=str;
        
        //$( "<br/><div class='alert alert-info'>"+msg+"</div>" ).appendTo( "#result" );
    }


    return {    
        show: show,
        notifySuccess: notifySuccess,
        alertError :alertError,
        addToTblBody: addToTblBody
    };

}()); // end of View closure

