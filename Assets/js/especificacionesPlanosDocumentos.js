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
	$("#numberToShow").val(data.Number);
	}
function inicio(){
	//funcion para traer el primer
	//documento registrado
	$.getJSON(
		"php/especificacion_registros/primerRegistro.php",
		{},
		function(data){
			setData(data)
		}
		);
	}
function anterior(){
	//funcion para traer el 
	//documento anterior al mostrado
	console.log($("#id").val());
	$.getJSON(
		"php/especificacion_registros/anteriorRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data)
		});
	}
function siguiente(){
	//funcion para traer el 
	//documento siguiente al mostrado
	$.getJSON(
		"php/especificacion_registros/siguienteRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data)
		});
	}
function final(){
	//funcion para traer el ultimo 
	//documento
	$.getJSON(
		"php/especificacion_registros/ultimoRegistro.php",
		{},
		function(data){
			setData(data)
		});
	}
function buscar(){
	$.getJSON(
		"php/especificacion_registros/buscar.php",
		{data:$("#codPdvsa").val()},
		function(data){
			if(data.Success) {
				setData(data);
				}
			else{
				$.alert({
					title:'Error',
					content:data.error
				});
			}
		});
	}
function agregar(){
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
				}
			else{
				console.log(data);
				$.alert({
						title:'Error',
						content:data.Msg
						});
				}
			},
		error:function(xhr,ajaxOptions,thrownError){
			alert(xhr.status+" "+thrownError);
			}
		});
	}
function eliminar(){
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
						}
					else{
						//Mostrar Msg de error
						}
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
		cancel:function(){}
		});	
	}