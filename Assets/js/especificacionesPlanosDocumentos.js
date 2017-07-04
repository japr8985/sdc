//Arreglo para traer todos los registros repetidos
var registros_repetidos = [];//un arreglo de objetos
var indice = 0;
//funcion para limpiar formulario
function limpiar(){
	//set id
	$("#id").val('');
	//set codigo de pdvsa
	$("#codPdvsa").val('');
	//set fase
	$("#fase").val('');
	//set status
	$("#status").val('');
	//set actividad
	$("#actividad").val('');
	//set disciplina
	$("#disciplina").val('');
	//set instalacion
	$('#instalacion').val('');
	//set documento/plano
	$("#docPlano").val('');
	//set digital/fisico
	$("#digitalFisico").val('');
	//set numero a mostrar
	$("#numberToShow").val('');
	}
//funcion para asignar valores al formulario
function setData(data){
	console.log(data);
	//set id
	$("#id").val(data.id);
	//set codigo de pdvsa
	$("#codPdvsa").val(data.CodPdvsa);
	//set fase
	$("#fase").val(data.fase);
	//set status
	$("#status").val(data.status);
	//set actividad
	$("#actividad").val(data.actividad);
	//set disciplina
	$("#disciplina").val(data.disciplina);
	//set instalacion
	$('#instalacion').val(data.instalacion);
	//set documento/plano
	$("#docPlano").val(data.docPlano);
	//set digital/fisico
	$("#digitalFisico").val(data.digitalFisico);
	//set numero a mostrar
	$("#numberToShow").val(data.Number);
	//ocultar circulo de carga
	$("#loader").prop('hidden',true);
	}
//funcion para ir al primer registro
function inicio(){
	//funcion para traer el primer
	//documento registrado
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/especificacion_registros/primerRegistro.php",
		{},
		function(data){
			setData(data)
		}
		);
	}
//funcion para ir al registro anterior
function anterior(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	//funcion para traer el 
	//documento anterior al mostrado
	$.getJSON(
		"php/especificacion_registros/anteriorRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data)
		});
	}
//funcion para ir al siguiente registro
function siguiente(){
	//funcion para traer el 
	//documento siguiente al mostrado
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/especificacion_registros/siguienteRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data)
		});
	}
//funcion para ir al ultimo registro
function final(){
	//funcion para traer el ultimo 
	//documento
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/especificacion_registros/ultimoRegistro.php",
		{},
		function(data){
			setData(data)
		});
	}
//funcion para buscar un registro en especifico
function buscar(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/especificacion_registros/buscar.php",
		{data:$("#codPdvsa").val()},
		function(data){
			if(data.Success) {
				if (data.Coincidencia > 1){
				$.confirm({
					title:'Registro repetido',
					content:'Se han encontrado '+data.Coincidencia+' registros iguales a este. ¿Desea visualizarlos?',
					confirm:function(){
						registros_repetidos = data.Data;
						console.log(data.Data);
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
			else{
				//mostrar circulo de carga
				$.alert({
					title:'Error',
					content:data.error
				});
			}
			$("#loader").prop('hidden',true);
		});
	}
//funcion para agregar un nuevo registro
function agregar(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	//variable donde se arma el 
	//a enviar al php
	var obj ={
		codPdvsa 	: $('#codPdvsa').val(),
		fase 		: $('#fase option:selected').val(),
		status 		: $('#status option:selected').val(),
		disciplina 	: $('#disciplina option:selected').val(),
		actividad 	: $('#actividad option:selected').val(),
		instalacion : $("#instalacion").val(),
		doc_plano 	: $("#docPlano").val(),
		digitalFisico:$("#digitalFisico").val()
		};
	console.log(obj);
	$.ajax({
		url: "php/especificacion_registros/agregarRegistro.php",
		type:"POST",
		data: obj,
		dataType: "json",
		success:function(data){
			if (data.Success){
				$.alert({
						title:'Agregado',
						content:data.Msg
						});
				$("#loader").prop('hidden',true);
				}
			else{
				console.log(data);
				$.alert({
						title:'Error',
						content:data.Msg
						});
				$("#loader").prop('hidden',true);
				}
			},
		error:function(xhr,ajaxOptions,thrownError){
			$.alert({
				title:xhr,
				content:xhr.status+' '+thrownError
				});
			}
		});
	}
//funcion para eliminar el registro que aparece en el formulario
function eliminar(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.confirm({
		title:'Confirmar',
		content:'Desea realmente eliminar este registro?',
		confirm:function(){
			
			$.ajax({
				url:"php/especificacion_registros/eliminarRegistro.php",
				type:'POST',
				data:{codpdvsa : $('#codPdvsa').val()},
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
							title:'Eliminado',
							content:data.Msg+' '+data.Error
							});
						}
					$("#loader").prop('hidden',true);
					},
				error:function(xhr,ajaxOptions,thrownError){
					$.alert({
						title:xhr.status,
						content: xhr.status+" "+thrownError
						});
					//alert(xhr.status+" "+thrownError);
					}
				});
			},
		cancel:function(){
			//mostrar circulo de carga
			$("#loader").prop('hidden',true);
		}
		});	
	}
//funcion para actualizar el registro que aparece en el formulario
function actualizar(){
	$("#loader").prop('hidden',false);
	var obj={
		id:$("#id").val(),
		codPdvsa:$("#codPdvsa").val(),
		fase: $("#fase").val(),
		status:$("#status").val(),
		actividad: $("#actividad").val(),
		disciplina:$("#disciplina").val(),
		instalacion:$('#instalacion').val(),
		docPlano:$("#docPlano").val(''),
		digitalFisico:$("#digitalFisico").val()
	};
	$.ajax({
		url:'php/especificacion_registros/actualizar.php',
		data:obj,
		method:'POST',
		dataType:'json',
		success:function(data){

		},
		error:function(xhr,status,error){

		}
	});
	$("#loader").prop('hidden',true);
	}
//funcion para asignar valores a la ventana modal
function set_rep(data,index){
	$("#modalActividad").val(data.actividad);
	$("#modalcodpdvsa").val(data.codpdvsa);
	$("#modalDigFis").val(data.digital_fisico);
	$("#modalDisc").val(data.disciplina);
	$("#modalDocPlano").val(data.doc_plano);
	$("#modalFase").val(data.fase);
	$("#modalId").val(data.id);
	$("#modalInstalacion").val(data.instalacion);
	$("#modalStatus").val(data.status);
	
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
		actividad : $("#modalActividad").val(),
		CodPdvsa : $("#modalcodpdvsa").val(),
		digitalFisico: $("#modalDigFis").val(),
		disciplina: $("#modalDisc").val(),
		docPlano:$("#modalDocPlano").val(),
		fase: $("#modalFase").val(),
		id: $("#modalId").val(),
		instalacion: $("#modalInstalacion").val(),
		status: $("#modalStatus").val(),
	};
	setData(obj);
	$("#coincidencia").modal('toggle');
	}