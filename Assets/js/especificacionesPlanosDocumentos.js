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
function buscar(){
	//mostrar circulo de carga
	$("#loader").prop('hidden',false);
	$.getJSON(
		"php/especificacion_registros/buscar.php",
		{data:$("#codPdvsa").val()},
		function(data){
			if(data.Success) {
				setData(data);
				}
			else{
				//mostrar circulo de carga
				$("#loader").prop('hidden',true);
				$.alert({
					title:'Error',
					content:data.error
				});
			}
		});
	}
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