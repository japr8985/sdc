function setData(data){
	//set id
	$("#id").val(data.id);
	//set ciudad
	$("#ciudad").val(data.ciudad);
	//set sede
	$("#sede").val(data.sede);
	//set departamento
	$("#departamento").val(data.departamento);
	//set numero de proyecto
	$("#nProyecto").val(data.nProyecto);
	//set a;o
	$("#year").val(data.year);
	//set numero de caja
	$('#nCaja').val(data.nCaja);
	//set codigo de carpeta
	$("#codCarpeta").val(data.codCarpeta);
	//set sub carpeta
	$("#subCarpeta").val(data.subCarpeta);
	//set numero de documento
	$('#nDoc').val(data.nDoc);
	//set codigo pdvsa
	$('#codPdvsa').val(data.codPdvsa);
	//set fase
	$('#fase').val(data.fase);
	//set revision
	$('#rev').val(data.rev)
	}
function inicio(){
	//funcion para traer el primer
	//documento registrado
	$.getJSON(
		"php/ubicacion/primerRegistro.php",
		{},
		function(data){
			setData(data)
		}
		);
	}
function anterior(){
	//funcion para traer el 
	//documento anterior al mostrado

	$.getJSON(
		"php/ubicacion/anteriorRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data)
		});
	}
function siguiente(){
	//funcion para traer el 
	//documento siguiente al mostrado
	$.getJSON(
		"php/ubicacion/siguienteRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data)
		});
	}
function final(){
	//funcion para traer el ultimo 
	//documento
	$.getJSON(
		"php/ubicacion/ultimoRegistro.php",
		{},
		function(data){
			setData(data)
		});
	}
function buscar(){
	$.getJSON(
		"php/ubicacion/buscar.php",
		{data:$("#codPdvsa").val()},
		function(data){
			if (data.Success) {
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
		ciudad 			: $("#ciudad").val(),
		sede 			: $("#sede").val(),
		departamento 	: $("#departamento").val(),
		nproyecto 		: $("#nProyecto").val(),
		year 			: $("#year").val(),
		ncaja 			: $('#nCaja').val(),
		codcarpeta 		: $("#codCarpeta").val(),
		subcarpeta 		: $("#subCarpeta").val(),
		ndoc 			: $('#nDoc').val(),
		codpdvsa 		: $('#codPdvsa').val(),
		fase 			: $('#fase').val(),
		rev 			: $('#rev').val()
		};
	console.log(obj);
	$.ajax({
		url: "php/ubicacion/agregarRegistro.php",
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
				$.alert({
						title:'Error',
						content:data.Msg
						});
				}
			},
		error:function(xhr,ajaxOptions,thrownError){
			$.alert({
						title:xhr.status,
						content:xhr.status+" "+thrownError
						});
			//alert(xhr.status+" "+thrownError);
			}
		});
	}
function eliminar(){
	$.confirm({
		title:'Confirmar',
		content:'Desea realmente eliminar este registro?',
		confirm:function(){
			$.ajax({
			url:"php/ubicacion/eliminarRegistro.php",
			type:'POST',
			data:{codpdvsa : $('#codPdvsa').val()},
			dataType:'json',
			success:function(data){
				console.log(data);
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
					}//fin if Success == true
				else{
					//mostrar msg de error
					}//fin else
				},
			error:function(xhr,ajaxOptions,thrownError){
				$.alert({
						title:xhr.status,
						content: xhr.status+" "+thrownError
						});
				//alert(xhr.status+" "+thrownError);
				}
			});//fin function y ajax
			},
		cancel:function(){}
		});
	
	
	}