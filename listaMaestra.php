<?php 
    include('conexion/conexion.php');
    include('header.php'); 
    ini_set('display_errors', 1); 
/*---------------------------------
        numero total de paginas    
-----------------------------------*/
//total de registros 
$sql = "SELECT count(id) FROM registros_total WHERE status ='ACTIVO'";//cantidad de registros ACTIVOS
$query = $mysqli->query($sql);//ejecucion de consultas
$total = $query->fetch_array();//transformando a un arreglo
$total_registros = $total[0];//accediendo a la primera posicion donde se encuentra
//el total de registros
//obtener la cantidad de paginas
$paginas = ceil($total_registros / 200);//--> 200 registros por pagina
?>
<link rel="stylesheet" href="Assets/css/listamaestra.css">
<div class="container">
    <div class="row">
        <div class="text-center">
            <div class="col-md-3">
                <button class="btn btn-default" onClick="imprimir()">Imprimir</button>
            </div>
            <div class="col-md-3">
                <button class="btn btn-default" onClick="filtradoPorFechas()">Reporte Por filtrado de fecha</button>
            </div>
            <div class="col-md-3">
                <input type="text" id="search" class="form-control" placeholder="Registro a buscar">
            </div>
            <div class="col-md-3">
                <button class="btn btn-default" onClick="buscarCodigo()">
                    Buscar
                </button>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="container-fluid">
    <div id="results"></div>
    <hr>
    <div class="row">
        <div class="text-center">
            <input type="text" class="numbers" readonly value="0" id="actualID">/<input type="text" class="numbers" readonly value="<?php echo $total_registros; ?>">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="text-center">
                <button class="btn btn-default" onClick="inicio()">Inicio</button>
                <button class="btn btn-default" onClick="fin()">Fin</button>
                <button class="btn btn-default" onClick="anterior()">Anterior</button>
                <button class="btn btn-default" onClick="siguiente()">Siguiente</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="text-center">
            <div class="pagination"></div>
        </div>
    </div>
        
</div>
<!--modal Filtrado por fecha -->
<div class="modal fade" id="filtradoPorFechasModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Lista Maestra - Filtrado Por fecha</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="desde">
                        Desde
                    </label>
                    <input type="date" class="form-control" id="desde">
                </div>
                <div class="form-group">
                    <label for="hasta">
                        Hasta
                    </label>
                    <input type="date" id="hasta" class="form-control">
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onClick="generarFiltradoPorFecha()" data-dismiss="modal">
                    Generar
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
</div>
<!--/modal Filtrado por fecha -->
<!-- modal vista de registro-->
<div class="modal fade" id="showRegistro" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <input type="text" class="numbers" readonly value="0" id="numberReg">/<input type="text" class="numbers" readonly value="0" id="totalReg">
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="codpdvsa">
                        Cod. PDVSA
                    </label>
                    <input type="text" id="codpdvsa" class="form-control">      
                </div>
                <div class="col-md-6">
                    <label for="descripcion">
                        Descripcion
                    </label>
                    <textarea name="" id="descripcion" cols="60" rows="5" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="rev">
                        Rev.
                    </label>
                    <input type="text" id="rev" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="fecha">
                        Fecha
                    </label>
                    <input type="date" id="fecha" class="form-control">
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="codCliente">
                        Cod. Cliente
                    </label>
                    <input type="text" class="form-control" id="codCliente">
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="disciplina">
                        Disciplina
                    </label>
                    <input type="text" class="form-control" id="disciplina">
                </div>
                <div class="col-md-6">
                    <label for="fase">
                        Fase
                    </label>
                    <input type="text" class="form-control" id="fase">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" id="searchBefore" disabled onClick="beforeReg()">
            Anterior
        </button>
        <button class="btn btn-primary" id="searchNext" disabled onClick="nextReg()">
            Siguiente
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal vista de registro -->
<script src="Assets/js/bootpag.min.js"></script>
<script src="Assets/js/listaMaestra.js"></script>
<script>
$(document).ready(function(){
    $("#results").load("php/lista_maestra/numero_paginas.php");
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
        $("#results").load("php/lista_maestra/numero_paginas.php", {'page':num});
    });
    
});
</script>