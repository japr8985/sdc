<!DOCTYPE html>
<html>
<head>
	<title>Sistema De Control Documental</title>
	<link rel="stylesheet" type="text/css" href="Assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/general.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/login.css">
  	<script src="Assets/js/jquery-1-11-03.js"></script>
  	<script src="Assets/js/bootstrap.js"></script>
  	<script src="Assets/js/listaMaestra.js"></script>
</head>
<body>
	<div class="container-fluid">
		<ul>
			<li><a href="#">Lista Maestra</a></li>
			<li><a href="#">Ubicacion de Registros (PDVSA)</a></li>
			<li><a href="#">Especificaciones de Registros</a></li>
			<li><a href="#">Registros PDVSA</a></li>
			<li><a href="#">Registros Externos</a></li>
			<li><a href="#">Tablas, Consultas e Informes</a></li>
			<li><a href="#">Salir</a></li>
		</ul>
		<table id="listaMaestra"class="table table-hoverable">
			<thead>
				<tr>
					<td>Codigo PDVSA</td>
					<td>Descripcion</td>
					<td>Revision</td>
					<td>Fase</td>
					<td>Disciplina</td>
					<td>Fecha de Revision/Emision</td>
				</tr>
			</thead>
			<tbody id="cuerpoListaMaestra">
				
			</tbody>
		</table>
	</div>
</body>
</html>