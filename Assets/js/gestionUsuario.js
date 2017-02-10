function limpiarCrearUsuario(){
    $("#name").val('');
    $("#username").val('');
    $("#correo").val('');
    $("#pass").val('');
    $("#confirm").val('');
    $("#email").val('@pdvsa.com');
    $("#type").val('user');
}
function crearUsuario() {
    var obj = {
        name    : $("#name").val(),
        user    : $("#username").val(),
        correo  : $("#correo").val(),
        pass    : $("#pass").val(),
        confirm : $("#confirm").val(),
        email   : $("#email").val(),
        type    : $("#type").val()
    }
    console.log(obj);
    $.ajax({
        url:'php/session/crearUsuario.php',
        method:'POST',
        data:obj,
        dataType:'json',
        success:function(data){
            $("#myModal").modal('hide');
            limpiarCrearUsuario();
            if (data.Success){
                $.alert({
                    title:'',
                    content:data.Msg,
                });
            }
            else{
                $.alert({
                    title:'Error',
                    content:data.Msg+' '+data.Error,
                });
            }

        },
        error:function(xhr,status,error){
            $.alert({
                title:xhr.status,
                content:xhr.status+" "+thrownError
                });
        }
    })
}
function eliminarUsuario(id){
    $("#loader").prop('hidden',false);
    console.log(id);
    $.confirm({
        title:'Confirmar',
        content:'Desea Realmente Eliminar a este usuario?',
        confirm:function(){
            $.ajax({
                url:'php/session/eliminarUsuario.php',
                type:'POST',
                data:{id:id},
                dataType:'json',
                success:function(data){
                    if (data.Success){
                        $.alert({
                            title:'Eliminado',
                            content:data.Msg
                        });
                    }
                    else{
                        $.alert({
                            title:'Error',
                            content:data.Msg+' '+data.Error
                        });
                    }
                    $("#loader").prop('hidden',true);
                },
                error:function(xhr,status,error){
                    $("#loader").prop('hidden',true);
                    $.alert({
                        title:xhr.status,
                        content: xhr.status+" "+error
                        });
                }
            });
        },
        cancel:function(){
            $("#loader").prop('hidden',true);
        }
    });
}
function limpiarEditarUsuario(){
    $("#editName").val('');
    $("#editUsername").val('');
    $("#editCorreo").val('');
    $("#editPass").val('');
    $("#editConfirm").val('');
    $("#editEmail").val('@pdvsa.com');
    $("#editType").val('user');
}
function editarUsuario(id){
    $.ajax({
        url:'php/session/editarUsuario.php',
        method:'POST',
        data:{id:id},
        dataType:'json',
        success:function(data){
          $("#idEdit").val(data.id)
          $("#editName").val(data.nombre);
          $("#editUsername").val(data.username);
          $("#editType").val(data.tipo);
          //--------------------------------
          var correo = data.correo.split("@");
          //console.log(correo); 
          $("#editCorreo").val(correo[0]);
          $("#editEmail").val("@"+correo[1]);
        },
        error:function(xhr,status,error){
            $.alert({
                title:xhr.status,
                content: xhr.status+" "+error
                });
        }
    })
    $("#editModal").modal(true);
}
function updateUsuario(){
    var obj = {
        id  : $("#idEdit").val(),
        name : $("#editName").val(),
        user: $("#editUsername").val(),
        pass: $("#editPass").val(),
        confirm: $("#editConfirm").val(),
        correo :$("#editCorreo").val(),
        email : $("#editEmail").val(),
        type :$("#editType").val()
    };
    console.log(obj)
    $.ajax({
        url:'php/session/updateUsuario.php',
        method:'POST',
        data:obj,
        dataType:'json',
        success:function(data){},
        error:function(xhr,status,error){}
    });
    console.log($("#idEdit").val());
}