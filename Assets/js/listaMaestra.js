var busqueda_cantidad = 0; //variable global para almacenar la 
//cantidad de registros traidos
var busqueda_registros = [] //almacena los registros en un arreglo
var busqueda_indice = 0; //indice de la busqueda
//------------------
var indice_pagina = 0;
/**
Realiza un busqueda por codigo y trae todos los registros
activos que tenga este codigo.
Muestra una ventana modal donde se puede visualizar la informacion
del registro
y pasar entre las coincidencias
*/
function buscarCodigo(){
	//captura el codigo escrito en el input
	var codigo = $("#search").val().trim();
	//realiza consulta para buscar todos los resultados que coincidan con el codigo
	$.ajax({
		url:"php/lista_maestra/buscar.php",//direccion de la consulta
		method:"post",//metodo Http
		data:{codigo:codigo},//objeto a enviar
		dataType:"json",//tipo de dato que se espera recibir
		beforeSend:function(){//antes de enviar
			$("#loader").prop('hidden',false);//mostrar animacion de loading
		},
		success:function(response){//una vez recibida la informacion
			console.log(response)
			$("#loader").prop('hidden',true);//ocultar la animacion de loading
			loadmodal(response);//carga informacion
			$("#showRegistro").modal(true);//mostrar ventana modal

		},
		error:function(xhr,status,error){
			$("#loader").prop('hidden',true);	
		}

	});
}
/**
Funcion para cargar la informacion a la ventana modal
recibe un obj

Se carga por defecto la primera coincidencia
**/
function loadmodal(obj){
	busqueda_cantidad = obj.cantidad;
	busqueda_registros = obj.registros;
	console.log(busqueda_registros);
	$("#codpdvsa").val(obj.registros[0].codpdvsa);
	$("#descripcion").val(obj.registros[0].descripcion);
	$("#rev").val(obj.registros[0].rev);
	$("#fecha").val(obj.registros[0].fecha);
	$("#codCliente").val(obj.registros[0].codCliente);
	$("#status").val(obj.registros[0].status);
	$("#disciplina").val(obj.registros[0].disciplina);
	$("#fase").val(obj.registros[0].fase);
	if (busqueda_cantidad > 0){//si tiene mas de 1 registro
		//habilita los botones de siguiente y anterior
		$("#searchBefore").prop('disabled',false);
		$("#searchNext").prop('disabled',false);
		//asigna los valores a la referencia
		$("#numberReg").val(1);//como siempre se muestra el primer registro
		//siempre se visualiza el primer registro
		$("#totalReg").val(busqueda_cantidad);
	}

}
/**
Funcion de siguiente para busqueda 
de registros en la ventana modal
**/
function nextReg(){
	if (busqueda_indice < busqueda_cantidad) {
		busqueda_indice = busqueda_indice + 1;
		$("#numberReg").val(busqueda_indice);
		$("#codpdvsa").val(busqueda_registros[busqueda_indice].codpdvsa);
		$("#descripcion").val(busqueda_registros[busqueda_indice].descripcion);
		$("#rev").val(busqueda_registros[busqueda_indice].rev);
		$("#fecha").val(busqueda_registros[busqueda_indice].fecha);
		$("#codCliente").val(busqueda_registros[busqueda_indice].codCliente);
		$("#status").val(busqueda_registros[busqueda_indice].status);
		$("#disciplina").val(busqueda_registros[busqueda_indice].disciplina);
		$("#fase").val(busqueda_registros[busqueda_indice].fase);
	}
}
function beforeReg(){
	if (busqueda_indice > -1 && busqueda_indice != 0) {
		busqueda_indice = busqueda_indice - 1;
		$("#numberReg").val(busqueda_indice);
		$("#codpdvsa").val(busqueda_registros[busqueda_indice].codpdvsa);
		$("#descripcion").val(busqueda_registros[busqueda_indice].descripcion);
		$("#rev").val(busqueda_registros[busqueda_indice].rev);
		$("#fecha").val(busqueda_registros[busqueda_indice].fecha);
		$("#codCliente").val(busqueda_registros[busqueda_indice].codCliente);
		$("#status").val(busqueda_registros[busqueda_indice].status);
		$("#disciplina").val(busqueda_registros[busqueda_indice].disciplina);
		$("#fase").val(busqueda_registros[busqueda_indice].fase);
	}
}
//Mostrar reporte de la lista maestra
function imprimir(){
	//window.location.href ="php/lista_maestra/info.php"
	window.open('php/lista_maestra/info.php','blank');
}
//validacion de fechas
function checkDates(fDesde,fHasta){
	var d = new Date(fDesde);
	var h = new Date(fHasta);

	if (fDesde == '' || fDesde == null || fDesde === 'undefined') 
		return false;	
	if (fHasta == '' || fHasta == null || fDesde === 'undefined')
		return false;
	if(d.getTime() > h.getTime())
		return false;
	return true; 
}
//Mostrar reporte por fechas
function generarFiltradoPorFecha(){

	if(checkDates($("#desde").val(),$("#hasta").val())){
		var ruta = "php/lista_maestra/reportByFecha.php?desde="+$("#desde").val()+"&hasta="+$("#hasta").val();
		window.open(ruta,'blank');
		}
	else{
		$.alert({
			title:'Error',
			content:'Error en la(s) fecha(s) seleccionada. Seleccione fechas validas para crear el reporte'
		});
	}
	
}
//ir al primer registro de la pagina
function inicio(){
	$("#loader").prop('hidden',false);
	$("#0").focus();
	$("#loader").prop('hidden',true);
	indice_pagina = 0;
	}
function fin(){
	$("#loader").prop('hidden',false);
	$("#199").focus();
	$("#loader").prop('hidden',true);
	indice_pagina = 199;
	}
function anterior(){
	if (indice_pagina >= 0){
		indice_pagina = indice_pagina - 1;
		$("#loader").prop('hidden',false);
		$("#"+indice_pagina).focus();
		$("#loader").prop('hidden',true);
		}
	}
function siguiente(){
	if (indice_pagina <= 199){
		indice_pagina = indice_pagina + 1;
		$("#loader").prop('hidden',false);
		$("#"+indice_pagina).focus();
		$("#loader").prop('hidden',true);
		}
	}
function limpiar(){
	//finalizado
	$("#loader").prop('hidden',false);
	$('table tbody').find('tr').remove()
	$("#loader").prop('hidden',true)
	}

function seleccionado(val){

	//se obtiene el valor ID del campo codpdvsa#
	var valor = val.split("codpdvsa");//['','#']
	showInfo(valor[1]);
	//se busca el valor del indice en el arreglo ids donde se encuentra ubicado tal #
	for (var i = 0; i < ids.length; i++) {
		if (ids[i] == valor[1]){
			//se le asigna el nuevo valor a la variable de ubicacion
			ub = i;
			//se rompe el ciclo
			break;
		}
	}
	$("#numberToShow").val(ub+1);
	//de tal forma se tiene el nuevo valor de ubicacion
	//donde el usuario realizo el focus
	console.log(ub);
}



function showInfo(id){
	console.log($("#codpdvsa"+id).val());
	$("#cod").val(
		$("#codpdvsa"+id).val()
		);
	$("#desc").val(
		$("#descripcion"+id).val()
		);
	$("#revision").val(
			$("rev"+id).val()
		);
	$("#disc").val(
			$("#disciplina"+id).val()
		);
	$("#fr").val(
			$("#fecha"+id).val()
		);
	$("#editModal").modal(true);
}

function filtradoPorFechas(){
	$("#filtradoPorFechasModal").modal(true);
}



