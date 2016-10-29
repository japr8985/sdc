//funcion para la asignacion de la data de respuesta
//a los diferentes campos del formulario
//AGREGAR LOADING
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
	}
function inicio(){
	//funcion para traer el primer
	//documento registrado
	$.getJSON(
		"php/registros/primerRegistro.php",
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
		"php/registros/anteriorRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data)
		});
	}
function siguiente(){
	//funcion para traer el 
	//documento siguiente al mostrado
	$.getJSON(
		"php/registros/siguienteRegistro.php",
		{id:$("#id").val()},
		function(data){
			setData(data)
		});
	}
function final(){
	//funcion para traer el ultimo 
	//documento
	$.getJSON(
		"php/registros/ultimoRegistro.php",
		{},
		function(data){
			setData(data)
		});
	}
function buscar(){
	$.getJSON(
		"php/registros/buscar.php",
		{data:$("#codPdvsa").val()},
		function(data){
			setData(data);
		});
	}
function agregar(){
	//variable donde se arma el 
	//a enviar al php
	var obj ={
		codPdvsa 		: $('#codPdvsa').val(),
		descripcion : $('#descripcion').val(),
		rev 				: $('#rev').val(),
		disciplina 	: $('#disciplina option:selected').val(),
		fase 				: $('#fase option:selected').val(),
		status 			: $('#status option:selected').val(),
		codCliente 	: $('#codCliente').val(),
		fecha 			: $('#rev_emi').val(),
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
				}
			else{
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
						//set id
						$("#id").val('');
						//set codigo de pdvsa
						$("#codPdvsa").val('');
						//set descripcion
						$("#descripcion").val('');
						//set revision
						$("#rev").val('');
						//set disciplina
						$("#disciplina").val('');
						//set fase
						$("#fase").val('');
						//set status
						$("#status").val('');
						//set codigo cliente
						$("#codCliente").val('');
						//set fecha
						$("#fecha").val('');
						}
					else{
						//
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
	var yesno=confirm('Desea realmente eliminar este registro?');
	if (yesno) {
		$.post(
			"php/registros/eliminarRegistro.php",
			{codpdvsa : $('#codPdvsa').val()},
			function(data){
				console.log(data);
				if (data.Success){
					//set id
					$("#id").val('');
					//set codigo de pdvsa
					$("#codPdvsa").val('');
					//set descripcion
					$("#descripcion").val('');
					//set revision
					$("#rev").val('');
					//set disciplina
					$("#disciplina").val('');
					//set fase
					$("#fase").val('');
					//set status
					$("#status").val('');
					//set codigo cliente
					$("#codCliente").val('');
					//set fecha
					$("#fecha").val('');
					}
				
			});
		}//fin if
	
	}