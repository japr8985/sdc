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
           <label for="name">
               Nombre
           </label>
           <input type="text" class="form-control" id="name">
           <hr>
            <label for="username">
                Nombre de Usuario
            </label>
            <input type="text" class="form-control" id="username">
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
            <label for="pass">
                Contraseña
            </label>
            <input type="password" class="form-control" id="pass">
            <hr>
            <label for="confirm">
                Confirmacion
            </label>
            <input type="password" class="form-control" id="confirm">
            <hr>
            <label for="type">
                Tipo de Usuario
            </label>
            <select id="type" class="form-control">
                <option value="user">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpiarCrearUsuario()">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="crearUsuario()">Crear</button>
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
            <select id="editType" class="form-control">
                <option value="user">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpiarEditarUsuario()">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="updateUsuario()">Actualizar</button>
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