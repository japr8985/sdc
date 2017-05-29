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
function anterior(){
	$("#loader").prop('hidden',false);
	//funcion para traer el 
	//documento anterior al mostrado
	//mostrar circulo de carga
	if ($("#numberToShow").val() != 1){
		$.getJSON(
			"php/registros/anteriorRegistro.php",
			{id:$("#id").val()},
			function(data){
				limpiar();
				setData(data);

			});
		}
	}
function siguiente(){
	if ($("#numberToShow").val() != $("#totalnumbers").val()) {
		$("#loader").prop('hidden',false);
		$.ajax({
			url:"php/registros/siguienteRegistro.php",
			data:{id:$("#id").val()},
			method:'POST',
			dataType:'json',
			success:function(data){
				limpiar();
				setData(data);
				$("#loader").prop('hidden',true);
			},
			error:function(xhr,status,error){
				$("#loader").prop('hidden',true);
				}
			});
	}
	
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
function buscar(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/registros/buscar.php",
		{data:$("#codPdvsa").val()},
		function(data){
			limpiar();
			setData(data);
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
				}
			else{
				$.alert({
						title:'Error',
						content:data.Msg+" "+data.Error
						});
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
			}
			else{
				$.alert({
					title:'Error',
					content:data.Msg+' '+data.Error
				});
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
}