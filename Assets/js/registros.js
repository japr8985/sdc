//Arreglo para traer todos los registros repetidos
var registros_repetidos = [];//un arreglo de objetos
var indice = 0;

//funcion para la asignacion de la data de respuesta
//a los diferentes campos del formulario
//AGREGAR LOADING
function limpiar(){
	//clear id
	$("#id").val('');
	//clear codigo de pdvsa
	$("#codPdvsa").val('');
	//clear descripcion
	$("#descripcion").val('');
	//clear revision
	$("#rev").val('');
	//clear disciplina
	$("#disciplina").val('');
	//clear fase
	$("#fase").val('');
	//clear status
	$("#status").val('');
	//clear codigo cliente
	$("#codCliente").val('');
	//clear fecha
	$("#fecha").val('');
	//clear numero del registro
	$("#numberToShow").val('');
	//habilitar boton para agregar registro
	//$("#btnAgregar").attr('disabled',false);
	//$("#anterior").prop("disabled",true);
	//$("#siguiente").prop('disabled',true);
	}
function setData(data){
	console.log(data)
	//set id
	$("#id").val(data.ID);
	//set codigo de pdvsa
	$("#codPdvsa").val(data.CodPdvsa);
	//set descripcion
	$("#descripcion").val(data.Descripcion);
	//set revision
	$("#rev").val(data.Rev);
	//set disciplina
	$("#disciplina").val(data.Disciplina);
	//set fase
	$("#fase").val(data.Fase);
	//set status
	$("#status").val(data.Status);
	//set codigo cliente
	$("#codCliente").val(data.CodCliente);
	//set fecha
	$("#fecha").val(data.fecha);
	//set numero del registro
	$("#numberToShow").val(data.Number);
	//ocultar circulo de carga
	$("#loader").prop('hidden',true);
	}
function inicio(){
	//funcion para traer el primer
	//documento registrado
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/registros/primerRegistro.php",
		{},
		function(data){
			limpiar();
			setData(data);
		}
		);
		
	}
function final(){
	//funcion para traer el ultimo 
	//documento
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.ajax({
		url:"php/registros/ultimoRegistro.php",
		method:'post',
		dataType:'json',
		success:function(data){
			limpiar();
			setData(data);
			
		},
		error:function(xhr,status,error){
			$.alert({
				title:'Error',
				content:xhr.status+" "+status+" "+error
			})
		}
	});

	}
function siguiente(){
	if ($("#numberToShow").val() != $("#totalnumbers").val()) {
		$("#loader").prop('hidden',false);
		$.ajax({
			url:"php/registros/siguienteRegistro.php",
			data:{
				id:$("#id").val(),
				codpdvsa:$("#codPdvsa").val()
			},
			method:'POST',
			dataType:'json',
			success:function(data){
				console.log(data);
					$("#loader").prop('hidden',true);
					limpiar();
					setData(data);					
					$("#btnAgregar").attr('disabled',true);
				},
			error:function(xhr,status,error){
				$("#loader").prop('hidden',true);
				}
			});
	}
	
	}
function anterior(){
	//funcion para traer el 
	//documento anterior al mostrado
	//mostrar circulo de carga

	$("#loader").prop('hidden',false);
	$.ajax({
		url:'php/registros/anteriorRegistro.php',
		data:{id:$("#id").val()},
		method:'post',
		dataType:'json',
		success:function(data){
			limpiar();
			setData(data);
			$("#btnAgregar").attr('disabled',true);
		},
		error:function(xhr,status,error){
			$.alert({
				title:'Error',
				content:xhr.status+" "+error
			});
		}
	});
	$("#loader").prop('hidden',true);
	$("#btnAgregar").attr('disabled',true);
	}
function buscar(){

	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/registros/buscar.php",
		{data:$("#codPdvsa").val()},
		function(data){
			console.log(data);
			limpiar();
			if (data.Coincidencia > 1){
				$.confirm({
					title:'Registro repetido',
					content:'Se han encontrado '+data.Coincidencia+' registros iguales a este. ¿Desea visualizarlos?',
					confirm:function(){
						registros_repetidos = data.Data;
						set_rep(registros_repetidos[0],1);
						//dispara modal
						$("#coincidencia").modal(true);
						},
					cancel:function(){}
				});
			}
			setData(data);
			//$("#btnAgregar").attr('disabled',true);
			if (data.ID == ''){
				$.alert({
						title:'Busqueda',
						content:'No se ha encontrado registro'
						});
				$("#loader").prop('hidden',true);
			}
		});
	
	}
function agregar(){
	//variable donde se arma el 
	//a enviar al php
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	var obj ={
		codPdvsa 		: $('#codPdvsa').val(),
		descripcion : $('#descripcion').val(),
		rev 				: $('#rev').val(),
		disciplina 	: $('#disciplina option:selected').val(),
		fase 				: $('#fase option:selected').val(),
		status 			: $('#status option:selected').val(),
		codCliente 	: $('#codCliente').val(),
		fecha 			: $('#fecha').val(),
		};
	console.log(obj);
	$.ajax({
		url: "php/registros/agregarRegistro.php",
		type:"POST",
		data: obj,
		dataType: "json",
		success:function(data){
			if (data.Success){
				$.alert({
						title:'Agregado',
						content:data.Msg
						});
				//ocultar circulo de carga
				$("#loader").prop('hidden',true);
				$("#codPdvsa").removeClass('campo-requerido');
				$("#descripcion").removeClass('campo-requerido');
				$("#rev").removeClass('campo-requerido');
				}
			else{
				$.alert({
						title:'Error',
						content:data.Msg+" "+data.Error
						});
				$("#"+data.Campo).addClass('campo-requerido').focus();
				//ocultar circulo de carga
				$("#loader").prop('hidden',true);
				}
			},
		error:function(xhr,ajaxOptions,thrownError){
			$.alert({
				title:'Error',
				content:xhr.status+" "+thrownError
			});
			//ocultar circulo de carga
			$("#loader").prop('hidden',true);
			}
		});
	}
function eliminar(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	var patron = /^\s*$/;
	if (!patron.test($("#codPdvsa").val())){
		$.confirm({
		title:'Confirmar',
		content:'Desea realmente eliminar este registro?',
		confirm:function(){
			$.ajax({
				url:"php/registros/eliminarRegistro.php",
				data:{codpdvsa : $('#codPdvsa').val()},
				method:'POST',
				dataType:'json',
				success:function(data){
					if (data.Success){
						$.alert({
							title:'Eliminado',
							content:data.Msg
							});
						limpiar();
						}
					else{
						$.alert({
							title:'Error',
							content:data.Msg+'. '+data.Error
							});
						}
					$("#loader").prop('hidden',true);
				},
				error:function(xhr,ajaxOptions,thrownError){
				$.alert({
						title:xhr.status,
						content: xhr.status+" "+thrownError
						});
				//ocultar circulo de carga
				$("#loader").prop('hidden',true);
				//alert(xhr.status+" "+thrownError);
				}
				});
			},
		cancel:function(){
				//ocultar circulo de carga
				$("#loader").prop('hidden',true);
		}
	});
	}
	else{
		$.alert({
			title:'Error',
			content: 'No se puede eliminar. Codigo Pdvsa Vacio'
		});
	}
	
	$("#btnAgregar").attr('disabled',true);
	$("#loader").prop('hidden',true);
	}
function actualizar(){
	$("#loader").prop('hidden',false);
	var obj ={
		id 					: $('#id').val(),
		codPdvsa 		: $('#codPdvsa').val(),
		descripcion : $('#descripcion').val(),
		rev 				: $('#rev').val(),
		disciplina 	: $('#disciplina option:selected').val(),
		fase 				: $('#fase option:selected').val(),
		status 			: $('#status option:selected').val(),
		codCliente 	: $('#codCliente').val(),
		fecha 			: $('#fecha').val(),
		};
	$.ajax({
		url:'php/registros/actualizar.php',
		method:'POST',
		data:obj,
		dataType:'json',
		success:function(data){
			if (data.Success) {
				$.alert({
					title:'Actualizado',
					content:data.Msg
				});
				$("#codPdvsa").removeClass('campo-requerido');
				$("#descripcion").removeClass('campo-requerido');
				$("#rev").removeClass('campo-requerido');
			}
			else{
				$.alert({
					title:'Error',
					content:data.Msg+' '+data.Error
				});
				$("#"+data.Campo).addClass('campo-requerido').focus();
			}
			$("#loader").prop('hidden',true);
		},
		error:function(xhr,status,error){
			$.alert({
				title:'Error',
				content:xhr.status+" "+error
			});
			$("#loader").prop('hidden',true);
		}
	});
	limpiar();
	$("#btnAgregar").attr('disabled',true);
	}
//funcion para asignar los datos los registros repeditos
//index = indice + 1
function set_rep(data,index){
	$("#modalId").val(data.id)
	$("#modalCodPdvsa").val(data.codpdvsa);
	$("#modalDescripcion").val(data.descripcion);
	$("#modalRev").val(data.rev);
	$("#modalDisc").val(data.disciplina);
	$("#modalFase").val(data.fases);
	$("#modalCliente").val(data.codcliente);
	$("#modalFecha").val(data.fecha_rev);
	$("#modalStatus").val(data.status);

	$("#numberReg").val(index);
	$("#totalReg").val(registros_repetidos.length);	
}
//siguiente valor
function reg_next(){
	if (indice < registros_repetidos.length -1){
		indice = indice + 1;
		set_rep(registros_repetidos[indice],indice + 1);
	}
}
//valor anterior
function reg_before(){
	console.log(indice);
	if (indice > 0) {
		indice = indice - 1;
		set_rep(registros_repetidos[indice],indice + 1);
		console.log(indice);
	}
}
function seleccionar(){
	var obj ={
		ID : $("#modalId").val(),
		CodPdvsa 		: $('#modalCodPdvsa').val(),
		Descripcion : $('#modalDescripcion').val(),
		Rev 				: $('#modalRev').val(),
		Disciplina 	: $('#modalDisc option:selected').val(),
		Fase 				: $('#modalFase option:selected').val(),
		Status 			: $('#modalStatus option:selected').val(),
		CodCliente 	: $('#modalCliente').val(),
		fecha 			: $('#modalFecha').val(),
		};
		console.log(obj);
	setData(obj);
	$("#coincidencia").modal('toggle');
}
