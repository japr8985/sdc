<?php 
    include('conexion/conexion.php');
    include('header.php'); 
    ini_set('display_errors', 1);
?>
<?php 
/*
|--------------------------------------------
|   Generando paginacion en tabla 
|--------------------------------------------
*/
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 0;

$inicio = $page;

$sql = "SELECT * from usuarios ORDER BY id DESC limit $inicio, $limit";

$result = $mysqli->query($sql);
//-----------------------------------------------
$sql2 = "SELECT count(id) FROM usuarios";
$query = $mysqli->query($sql2);
$users = $query->fetch_array();
$total = $users[0];
$total_pages = ceil($total/$limit);
?>
<div class="container">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Crear Usuarios
</button>
   <hr>
    <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <td>
                Nombre
            </td>
            <td>
                Correo
            </td>
            <td>
                Nombre de Usuario
            </td>
            <td>
                Tipo
            </td>
            <td>
                Accion
            </td>
        </tr>
    </thead>
    <tbody>
        <?php while ($r = $result->fetch_object()): // ?>
        <tr>
            <td>
                <?php echo $r->nombre; ?>
            </td>
            <td>
                <?php echo $r->correo; ?>
            </td>
            <td>
                <?php echo $r->username; ?>
            </td>
            <td>
                <?php if ($r->tipo == 'user'): ?>
                    <div class="alert alert-info">
                        <span class="glyphicon glyphicon-user">Usuario</span> 
                    </div> 
                <?php else: ?>
                    <div class="alert alert-success">
                        <span class="glyphicon glyphicon-eye-open">Administrador</span> 
                    </div> 
                <?php endif; ?>
            </td>
            <td>
                <button class="btn btn-warning" onclick="editarUsuario(<?php echo $r->id; ?>)">
                    Actualizar
                </button>
                
                <button class="btn btn-danger" onclick="eliminarUsuario(<?php echo $r->id; ?>)">
                    Eliminar
                </button>
            </td>
        </tr>
        <?php endwhile; ?>
        
    </tbody>
</table>  
    <div class="pagination">
        <?php for ($i=1; $i <= $total_pages ; $i++): ?>
            <a href="gestionUsuarios.php?page=<?php echo $i; ?>" > <?php echo $i; ?></a>
        <?php endfor; ?>
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
|       VENTANA MODAL PARA CREAR USUARIOS
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
</body>
</html>