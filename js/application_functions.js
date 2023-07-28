
// let debug = true;
let debug = false;




function deleteEntity(entitytype, entityId, action){

    bootbox.confirm('Are you sure you want to delete this ?',function(result) {
        if(result === true){
            $.ajax({
                method: "POST",
                url: "ajax/ajax.php",
                dataType: "text",
                data: {
                    entity: entitytype,
                    id:entityId,
                    action: action
                },
                beforeSend: function(){
                    
                },
                error: function(){
                    bootbox.alert('An internal error has occurred. Please contact support');
                },
                success: function(data){
                    if(debug === true){
                        bootbox.alert(data);
                    }else{
                        if(data === 'success'){
                            document.location.reload();
                        }else{
                            bootbox.alert('This data could not be deleted. Please try again. If the problem persists, please contact support');
                        }
                    }
                }
            });
        }
    });
}





function updateStatus(entitytype, entityId, action){

    bootbox.confirm('Are you sure you want to update this ?',function(result) {
        if(result === true){
            $.ajax({
                method: "POST",
                url: "ajax/ajax.php",
                dataType: "text",
                data: {
                    entity: entitytype,
                    id:entityId,
                    action: action
                },
                beforeSend: function(){
                    
                },
                error: function(){
                    bootbox.alert('An internal error has occurred. Please contact support');
                },
                success: function(data){
                    if(debug === true){
                        bootbox.alert(data);
                    }else{
                        if(data === 'success'){
                            document.location.reload();
                        }else{
                            bootbox.alert('This data could not be deleted. Please try again. If the problem persists, please contact support');
                        }
                    }
                }
            });
        }
    });
}





function updateLibraryDependency(entityType, libraryId, parentLibraryId, action){

    bootbox.confirm('Are you sure you want to update this dependency relationship?',function(result) {
        if(result === true){
            $.ajax({
                method: "POST",
                url: "ajax/ajax.php",
                dataType: "text",
                data: {
                    entity:entityType,
                    id:libraryId,
                    parentId:parentLibraryId,
                    action: action
                },
                beforeSend: function(){
                    
                },
                error: function(){
                    bootbox.alert('An internal error has occurred. Please contact support');
                },
                success: function(data){
                    if(debug === true){
                        bootbox.alert(data);
                    }else{
                        if(data === 'success'){
                            document.location.reload();
                        }else{
                            bootbox.alert('This data could not be deleted. Please try again. If the problem persists, please contact support');
                        }
                    }
                }
            });
        }
    });
}



