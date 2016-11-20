<?php include('header.php'); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-4">
			<button onClick="cargar_lista_maestra()" class="btn btn-default">Cargar lista Maestra</button>
		</div>
		<div class="col-xs-4">
			<button onClick="buscarCodigo()" class="btn btn-default btn-disabled" id="btnSearch" disabled="true">Buscar Codigo</button>
		</div>
		<div class="col-xs-4">
			<input type="text" class="form-control" id="searchCode" disabled="true">
		</div>
		
	</div>
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<td></td>
					<td>Codigo PDVSA</td>
					<td>Descripcion</td>
					<td style="width: 50px;">Rev.</td>
					<td style="width: 110px;">Fase</td>
					<td style="width: 100px;">Disciplina</td>
					<td>Fecha de Revision/Emision</td>
				</tr>
			</thead>
				<tbody class="listaMaestraBox">
				
				</tbody>
			
		</table>
</div>
		<script src="Assets/js/listaMaestra.js"></script>
</body>
</html>