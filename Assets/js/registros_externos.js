//Arreglo para traer todos los registros repetidos
var registros_repetidos = [];//un arreglo de objetos
var indice = 0;
//funcion para limpiar formulario
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
//funcion para asignar valores al formulario
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
//funcion para ir al primer registro
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
//funcion para ir al registro anterior
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
//funcion para ir al siguiente registro
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
//funcion para ir al ultimo registro
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
//funcion para buscar registro
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
			else{
				if (data.Coincidencia > 1){
					$.confirm({
						title:'Registro repetido',
						content:'Se han encontrado '+data.Coincidencia+ ' registros iguales a este. ¿Desea visualizarlos?',
						confirm:function(){
							registros_repetidos = data.Data;
							set_rep(registros_repetidos[0],1);
							//dispara modal
							$("#coincidencia").modal(true);
						},
						cancel:function(){}
					});
				}
				else
					setData(data);
			}
		});
	}
//funcion para agregar un nuevo registro
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
//funcion para eliminar registro
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
//funcion para actualizar registro
function actualizar(){
	$("#loader").prop('hidden',false);
	var obj ={
		id					: $("#id").val(),
		codcliente 	: $("#codCliente").val(),
		descripcion	: $("#descripcion").val(),
		rev 				: $("#rev").val(),
		fecha				: $("#fecha").val(),
		disciplina	: $("#disciplina").val(),
		fase 				: $("#fase").val()
	};
	$.ajax({
		url:'php/registros_externos/actualizar.php',
		data:obj,
		method:'POST',
		dataType:'json',
		success:function(data){
			if (data.Success){
				$.alert({
					title:'Actualizado',
					content: data.Msg
					});
			}
			else{
				$.alert({
					title:'Error',
					content: data.Msg+" "+data.Error
					});
			}
			$("#loader").prop('hidden',true);
		},
		error:function(xhr,status,error){
			$.alert({
				title:xhr.status,
				content: xhr.status+" "+error
				});
			//ocultar circulo de carga
			$("#loader").prop('hidden',true);
		}
	});
	}
	
//funcion para asignar valores a la ventana modal
function set_rep(data,index){
	$("#modalId").val(data.id);
	$("#modalCliente").val(data.codCliente);
	$("#modalDescripcion").val(data.descripcion);
	$("#modalRev").val(data.rev);
	$("#modalDisc").val(data.disciplina);
	$("#modalFase").val(data.fase);
	$("#modalFecha").val(data.fecha_rev);

	$("#numberReg").val(index);
	$("#totalReg").val(registros_repetidos.length);
	}
//funcion para ir al siguiente registro de la ventana modal
function reg_next(){
	if (indice < registros_repetidos.length -1){
		indice = indice + 1;
		set_rep(registros_repetidos[indice],indice + 1);
	}
	}
//funcion para ir al registro anterior de la ventana modal
function reg_before(){
	if (indice > 0) {
		indice = indice - 1;
		set_rep(registros_repetidos[indice],indice + 1);
		}
	}
//funcion para pasar los valores de la ventana modal al formulario 
function seleccionar(){
	var obj ={
		id:$("#modalId").val(),
		codCliente:$("#modalCliente").val(),
		descripcion:$("#modalDescripcion").val(),
		rev:$("#modalRev").val(),
		disciplina:$("#modalDisc").val(),
		fase:$("#modalFase").val(),
		fecha:$("#modalFecha").val(),
	};
	setData(obj);
	$("#coincidencia").modal('toggle');
	}