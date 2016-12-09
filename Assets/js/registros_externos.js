function limpiar(data){
	//limpiando id
	$("#id").val('');
	//limpiando Codigo pdvsa
	$("#codCliente").val('');
	//limpiando descripcion
	$("#descripcion").val('');
	//limpiando Rev
	$("#rev").val('');
	//limpiando fecha
	$("#fecha").val('');
	//limpiando disciplina
	$("#disciplina").val('');
	//limpiando fase
	$("#fase").val('');
	//limpiando Number to show
	$("#numberToShow").val('');
	}
function setData(data){
	console.log(data);
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
	//set Number to show
	$("#numberToShow").val(data.Number);
	//ocultar circulo de carga
	$("#loader").prop('hidden',true);
	}
function inicio(){
	//primer registro externo
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/registros_externos/primerRegistro.php",
		{},
		function(data){
			setData(data);
		});
	}
function anterior(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/registros_externos/anteriorRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data)
		});
	}
function siguiente(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/registros_externos/siguienteRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data);
		});
	}
function final(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/registros_externos/ultimoRegistro.php",
		{},
		function(data){
			setData(data)
		});
	}
function buscar(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/registros_externos/buscar.php",
		{data:$("#codCliente").val()},
		function(data){
			if (data.id==null){
				$.alert({
					title:'Registro no encontrado',
					content:'No se ha podido encontrar el registro solicitado'
				})
			}
			setData(data);
		});
	}
function agregar(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
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
				$.alert({
						title:'Agregado',
						content:data.Msg
						});
				}
			else{
				$(function(){
					$.alert({
						title:'Error',
						content:data.Msg
						});				
					});
				}
			$("#loader").prop('hidden',true);
			},
		error:function(xhr,ajaxOptions,thrownError){
			$.alert({
						title:xhr.status,
						content:xhr.status+" "+thrownError
						});
			$("#loader").prop('hidden',true);
			}
	});
	}
function eliminar(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.confirm({
		title:'Confirmar',
		content:'Desea realmente eliminar este registro?',
		confirm:function(){
			$.ajax({
				url:"php/registros_externos/eliminarRegistro.php",
				data:{codcliente : $('#codCliente').val()},
				method:'POST',
				dataType:'json',
				success:function(){
					if (data.Success){
						$.alert({
							title:'Eliminado',
							content:data.Msg
							});
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
						//ocultar circulo de carga
						$("#loader").prop('hidden',true);
						}
					else{
						//Mostrar Msg de error
						}
					},
				error:function(xhr,status,thrownError){
					$.alert({
						title:xhr.status,
						content: xhr.status+" "+thrownError
						});
					//ocultar circulo de carga
					$("#loader").prop('hidden',true);
					}
				});
			},
		cancel:function(){
			$("#loader").prop('hidden',true);
			}
		});
	}