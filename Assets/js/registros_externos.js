function setData(data){
	//set id
	$("#id").val(data.id);
	//set Codigo pdvsa
	$("#codCliente").val(data.codCliente);
	//set descripcion
	$("#descripcion").val(data.descripcion);
	//set Rev
	$("#rev").val(data.rev);
	//set fecha
	$("#fecha").val(data.fecha);
	//set disciplina
	$("#disciplina").val(data.disciplina);
	//set fase
	$("#fase").val(data.fase);
	}
function inicio(){
	//primer registro externo
	$.getJSON(
		"php/registros_externos/primerRegistro.php",
		{},
		function(data){
			console.log(data);
			setData(data);
		});
	}
function anterior(){
	$.getJSON(
		"php/registros_externos/anteriorRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data)
		});
	}
function siguiente(){
	$.getJSON(
		"php/registros_externos/siguienteRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data);
		});
	}
function final(){
	$.getJSON(
		"php/registros_externos/ultimoRegistro.php",
		{},
		function(data){
			setData(data)
		});
	}
function buscar(){
	$.getJSON(
		"php/registros_externos/buscar.php",
		{data:$("#codCliente").val()},
		function(data){
			setData(data);
		});
	}
function agregar(){
	var obj = {
		codCliente 	: $('#codCliente').val(),
		descripcion : $('#descripcion').val(),
		rev 				: $('#rev').val(),
		fecha 			: $('#fecha').val(),
		disciplina  : $('#disciplina').val(),
		fase 				: $('#fase').val()};
	$.ajax({
		url:"php/registros_externos/agregarRegistro.php",
		type:"POST",
		data: obj,
		dataType: "json",
		success:function(data){
			if (data.Success){
				alert(data.Msg);
				}
			else{
				console.log(data);
				$(function(){
					alert(data.Msg)					
					});
				}
			},
		error:function(xhr,ajaxOptions,thrownError){
			alert(xhr.status+" "+thrownError);
			}
	});
	}
function eliminar(){
	var yesno=confirm('Desea realmente eliminar este registro?');
	if (yesno) {
		$.post(
			"php/registros_externos/eliminarRegistro.php",
			{codcliente : $('#codCliente').val()},
			function(data){
				console.log(data);
				if (data.Success){
					//set id
					$("#id").val('');
					//set Codigo pdvsa
					$("#codCliente").val('');
					//set descripcion
					$("#descripcion").val('');
					//set Rev
					$("#rev").val('');
					//set fecha
					$("#fecha").val('');
					//set disciplina
					$("#disciplina").val('');
					//set fase
					$("#fase").val('');
					}
				else{
					//Mostrar Msg de error
				}
			});
		}//fin if
	}