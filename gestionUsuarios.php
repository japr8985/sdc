<?php 
    ini_set('display_errors', 1);
    include('conexion/conexion.php');
    include('header.php'); 
?>
<?php 
/*
|--------------------------------------------
|   Generando paginacion en tabla 
|--------------------------------------------
*/

//-----------------------------------------------
$sql2 = "SELECT count(id) FROM usuarios";
$query = $mysqli->query($sql2);
$users = $query->fetch_array();
$total = $users[0];
$paginas = ceil($total/5);
?>
<div class="container">
<div class="row">
    <div class="text-center">
        <h1>
            Gestion de Usuarios
        </h1>
    </div>
</div>
<div class="row text-right">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Crear Usuarios
    </button>
</div>
   <hr>
    <div id="result"></div>  
</div> 
<div class="row">
    <div class="text-center">
        <div class="pagination"></div>
    </div>
</div>
    <div class="row">
        <div class="container">
            <div class="col-md-3 ">
                <a href="home.php" style="font-size: xx-large;">
                    <span>&larr;</span>
                    Regresar
                </a>
            </div>
        </div>
    </div>
<!--
|----------------------------------------------------------
|       VENTANA MODAL PARA CREAR USUARIOS
|----------------------------------------------------------
   -->   

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                &times;
            </span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Crear Usuario</h4>
      </div>
      <div class="modal-body">
        <form action="#" class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="name">
                       Nombre
                   </label>
                   <input type="text" class="form-control" id="name">
                </div>
                <div class="col-md-6">
                    <label for="username">
                        Nombre de Usuario
                    </label>
                    <input type="text" class="form-control" id="username">
                </div>
            </div>            
            <hr>
            <label for="correo">
                Correo
            </label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="correo">
                </div>  
                <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">@</span>
                        <select id="email" class="form-control">
                            <option value="@pdvsa.com">pdvsa.com</option>
                            <option value="@gmail.com">gmail.com</option>
                            <option value="@hotmail.com">hotmail.com</option>
                            <option value="@yahoo.com">yahoo.com</option>
                        </select>  
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="pass">
                        Contraseña
                    </label>
                    <input type="password" class="form-control" id="pass">
                </div>
                <div class="col-md-6">
                    <label for="confirm">
                        Confirmacion
                    </label>
                    <input type="password" class="form-control" id="confirm">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="type">
                        Tipo de Usuario
                    </label>
                    <select id="type" class="form-control">
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="cargo">
                        Cargo
                    </label>
                    <input type="text" name="cargo" id="cargo" class="form-control">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="phone">
                        Telefono
                    </label>
                    <input type="phone" name="phone" id="phone" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="sangre">
                        Tipo de sangre
                    </label>
                    <input type="text" name="sangre" id="sangre" class="form-control">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="direccion">
                        Direccion
                    </label>
                    <input type="text" name="direccion" id="direccion" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="cedula">
                        Cedula
                    </label>
                    <input type="text" name="cedula" id="cedula" class="form-control">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="crearUsuario()">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpiarCrearUsuario()">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--
|----------------------------------------------------------
|       VENTANA MODAL PARA EDITAR USUARIOS
|----------------------------------------------------------
   -->   

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                &times;
            </span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
      </div>
      <div class="modal-body">
        <form action="#" class="form-group">
            <input type="hidden" id="idEdit" >
           <label for="editName">
               Nombre
           </label>
           <input type="text" class="form-control" id="editName">
           <hr>
            <label for="editUsername">
                Nombre de Usuario
            </label>
            <input type="text" class="form-control" id="editUsername">
            <hr>
            <label for="editCorreo">
                Correo
            </label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="editCorreo">
                </div>  
                <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">@</span>
                        <select id="editEmail" class="form-control">
                            <option value="@pdvsa.com">pdvsa.com</option>
                            <option value="@gmail.com">gmail.com</option>
                            <option value="@hotmail.com">hotmail.com</option>
                            <option value="@yahoo.com">yahoo.com</option>
                        </select>  
                    </div>
                </div>
            </div>
            <hr>
            <label for="editPass">
                Contraseña
            </label>
            <input type="password" class="form-control" id="editPass">
            <hr>
            <label for="editConfirm">
                Confirmacion
            </label>
            <input type="password" class="form-control" id="editConfirm">
            <hr>
            <label for="editType">
                Tipo de Usuario
            </label>
            <div class="row">
                <div class="col-md-6">
                    <select id="editType" class="form-control">
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="editcargo">
                        Cargo
                    </label>
                    <input type="text" name="editcargo" id="editcargo" class="form-control">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <label for="editphone">
                        Telefono
                    </label>
                    <input type="editphone" name="editphone" id="editphone" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="editsangre">
                        Tipo de sangre
                    </label>
                    <input type="text" name="editsangre" id="editsangre" class="form-control">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="editdireccion">
                        Direccion
                    </label>
                    <input type="text" name="editdireccion" id="editdireccion" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="editcedula">
                        Cedula
                    </label>
                    <input type="text" name="editcedula" id="editcedula" class="form-control">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updateUsuario()">Actualizar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpiarEditarUsuario()">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!--
|----------------------------------------------------------
|       VENTANA MODAL PARA MOSTRAR USUARIOS
|----------------------------------------------------------
   -->   

<!-- Modal -->
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                &times;
            </span>
        </button>
        <h4 class="modal-title" id="myModalLabel"> Usuario</h4>
      </div>
      <div class="modal-body">
        <form action="#" class="form-group">
            <input type="hidden" id="idEdit" >
           <label for="showName">
               Nombre
           </label>
           <input type="text" class="form-control" id="showName">
           <hr>
            <label for="showUsername">
                Nombre de Usuario
            </label>
            <input type="text" class="form-control" id="showUsername">
            <hr>
            <label for="showCorreo">
                Correo
            </label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="showCorreo">
                </div>  
                <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">@</span>
                        <select id="showEmail" class="form-control">
                            <option value="@pdvsa.com">pdvsa.com</option>
                            <option value="@gmail.com">gmail.com</option>
                            <option value="@hotmail.com">hotmail.com</option>
                            <option value="@yahoo.com">yahoo.com</option>
                        </select>  
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="showAdmin">
                        Tipo de Usuario
                    </label>
                    <select id="showAdmin" class="form-control">
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="showCargo">
                        Cargo
                    </label>
                    <input type="text" name="showCargo" id="showCargo" class="form-control">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <label for="showPhone">
                        Telefono
                    </label>
                    <input type="showPhone" name="showPhone" id="showPhone" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="showSangre">
                        Tipo de sangre
                    </label>
                    <input type="text" name="showSangre" id="showSangre" class="form-control">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="showDireccion">
                        Direccion
                    </label>
                    <input type="text" name="showDireccion" id="showDireccion" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="showCedula">
                        Cedula
                    </label>
                    <input type="text" name="showCedula" id="showCedula" class="form-control">
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpiarShowUsuario()">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script src="Assets/js/gestionUsuario.js"></script>
<script src="Assets/js/bootpag.min.js"></script>
<script>
    $(document).ready(function(){
    $("#result").load("php/session/tablaUsuarios.php");
    $(".pagination").bootpag({
        total: "<?php echo $paginas; ?>",
        page: 1,
        maxVisible: 5,
        leaps: true,
        firstLastUse: true,
        first: '←',
        last: '→',
        wrapClass: 'pagination',
        activeClass: 'active',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
    }).on("page",function(e,num){
        $("#result").load("php/session/tablaUsuarios.php", {'page':num});
    });
    
});
</script>
</body>
</html>