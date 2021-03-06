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
        type    : $("#type").val(),
        cargo   : $("#cargo").val(),
        phone   : $("#phone").val(),
        sangre  : $("#sangre").val(),
        direccion: $("#direccion").val(),
        cedula : $("#cedula").val()
    }
    console.log(obj);
    $.ajax({
        url:'php/session/crearUsuario.php',
        method:'POST',
        data:obj,
        dataType:'json',
        success:function(data){
            
            //limpiarCrearUsuario();
            if (data.Success){
                $.alert({
                    title:'',
                    content:data.Msg,
                });
                $("#myModal").modal('hide');
            }
            else{
                $.alert({
                    title:'Error',
                    content:data.Msg+' '+data.Error,
                });
                $("#"+data.Campo).addClass('campo-requerido').focus();
            }

        },
        error:function(xhr,status,error){
            $.alert({
                title:xhr.status,
                content:xhr.status+" "+error
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
            console.log(data);
            $("#idEdit").val(data.id)
            $("#editName").val(data.nombre);
            $("#editUsername").val(data.username);
            $("#editType").val(data.tipo);
            $("#editcargo").val(data.cargo),
            $("#editphone").val(data.telefono),
            $("#editsangre").val(data.sangre),
            $("#editdireccion").val(data.direccion)
            $("#editcedula").val(data.cedula)
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
        type :$("#editType").val(),
        cargo:$("#editcargo").val(),
        phone: $("#editphone").val(),
        sangre:$("#editsangre").val(),
        direccion:$("#editdireccion").val(),
        cedula: $("#editcedula").val()
    };
    console.log(obj)
    $.ajax({
        url:'php/session/updateUsuario.php',
        method:'POST',
        data:obj,
        dataType:'json',
        success:function(data){
          if (data.Success) {
            $.confirm({
              title:'Usuario Actualizado',
              content:data.Msg,
              confirm:function(){
                location.reload();
              },
              cancel:function(){
                location.reload();
              }
            });
          }
          else{
            var msj = data.Msg;
            msj = data.Msg === "undefined" ? data.Msg : data.Msg + ' ' + data.Error;
            $.alert({
              title: 'Error Al actualizar',
              content:data.Msg+" "+msj
            });
          }
        },
        error:function(xhr,status,error){
          $.alert({
            title:'Error',
            content:xhr.status+'. '+error
          });
        }
    });
    console.log($("#idEdit").val());
}
function mostrarUsuario(id) {
    $.ajax({
        url:'php/session/showUser.php',
        method:'POST',
        data:{
            id:id
        },
        dataType:'json',
        success:function(response){
            $("#showName").val(response.nombre);
            $("#showUsername").val(response.username);
            var correo = response.correo.split("@");
            $("#showCorreo").val(correo[0]);
            $("#showEmail").val(correo[1]);
            $("#showCargo").val(response.cargo);
            $("#showPhone").val(response.telefono);
            $("#showSangre").val(response.sangre);
            $("#showCedula").val(response.cedula);
            $("#showDireccion").val(response.direccion);

            $("#showModal").modal(true);
        },
        error:function(xhr,status,error){
          $.alert({
            title:'Error',
            content:xhr.status+'. '+error
          });
        }
    });
    console.log(id);
}

function limpiarShowUsuario() {
    $("#showName").val('');
    $("#showUsername").val('');
    $("#showCorreo").val('');
    $("#showEmail").val('');
    $("#showCargo").val('');
    $("#showPhone").val('');
    $("#showSangre").val('');
    $("#showCedula").val('');
    $("#showDireccion").val('');

}
