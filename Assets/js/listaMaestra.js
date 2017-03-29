//areglo que contiene todos los id de los registros traidos de la tabla lista maestra
//estos funcionaran para poder moverse por la tabla generada sin necesidad de realizar
//mas solicitudes ajax, ni consultas a DB
var ids = new Array();
//esta variable sirve para tener el indice del arreglo (ids) y complementar la funcionalidad del arreglo
var ub = 0;
function cargar_lista_maestra(){
	$("#loader").prop('hidden',false);
	//limpiando arreglo de ids
	ids=[];
	//limpiando tabla
	$('table tbody').find('tr').remove()
	$.ajax({
		url:'php/lista_maestra/lista_maestra.php',
		method:'POST',
		dataType:'json',
		success:function(res){
			var data 	= res[0];
			var filas 	= res[1];
			//si no hay registros para mostrar
			if (data == 0) {
				$.alert({
				title:'Lista Maestra',
				content:'No hay registros para visualizar'
				});
			$("#loader").prop('hidden',true);
			}//fin if
		else{
			//limpiar contenido de la lista maestra
			$('#listaMaestra').empty()
			//creando nuevo contenido para la lista
			for (var i = 0; i < data.length; i++) {
				//agregando filas a la tabla
				//crea una linea nueva
				$("table tbody").append(
					row(data[i][0])
					);
				$("#codpdvsa"+(data[i][0].trim())).val(data[i][1]);
				$("#descripcion"+data[i][0]).val(data[i][2]);
				$("#rev"+data[i][0]).val(data[i][3]);
				$("#fase"+data[i][0]).val(data[i][4]);
				$("#disciplina"+data[i][0]).val(data[i][5]);
				if (data[i][5] != null)
					$("#fecha"+data[i][0]).val(data[i][6]);
				ids.push(data[i][0]);
			}//fin for
		//mostrando la cantidad de filas
		$("#totalnumbers").val(filas);
		$("#loader").prop('hidden',true);
		//habilitando boton de busqueda
		$("#btnSearch").prop('disabled',false);
		//habilitando input de busqueda
		$("#searchCode").prop('disabled',false);
		}//fin else
	},//fin success
	error:function(xhr,status,error){
		$.alert({
			title:xhr.status,
			content:xhr.status+" "+error
		});
		$("#loader").prop('hidden',true);
		}//fin error
	});//fin ajax
	}//fin fucntion
function row(data){
	//funcion para dibujar la fila del registro creando un id para cada elemento unico segun su id en la db
	var row ='<tr>';
			row = row+'<td>';
				row = row+'<input class="form-control" readonly type="hidden" value="'+data+' id="'+data+'">';
			row = row+'</td>';
			row = row+'<td>';
				row = row+'<input class="form-control" readonly onClick="seleccionado(this.id)"style="width: 300px;" type="text" id="codpdvsa'+data+'">';
			row = row+'</td>';
			row = row+'<td>';
				row = row+'<input class="form-control" readonly style="width: 300px;" type="text" id="descripcion'+data+'">';
			row = row+'</td>';
			row = row+'<td>';
				row = row+'<input class="form-control" readonly type="text" id="rev'+data+'" style="width:60px;">';
			row = row+'</td>';
			row = row +'<td>';
			//al id del select se le concatena el id del registro para distinguirlo de los demas
			//y asignarle el valor en el success del ajax
				row = row +'<select class="form-control" readonly style="width: 110px;" id="fase'+data+'">';
					row = row+'<option value=""></option>';
					row = row+'<option value="C">CONCEPTUALIZAR</option>';
					row = row+'<option value="D">DEFINIR</option>';
					row = row+'<option value="I">IMPLANTAR</option>';
					row = row+'<option value="O">OPERAR</option>';
					row = row+'<option value="V">VISUALIZAR</option>';
				row = row +'</select>';
			row = row +'</td>';
			row = row + '<td>';
			//al id del select se le concatena el id del registro para distinguirlo de los demas
			//y asignarle el valor en el success del ajax
				row = row +'<select class="form-control" readonly style="width: 100px;" id="disciplina'+data+'">';
					row = row+'<option value=""></option>';
					row = row+'<option value="C">Civil</option>';
					row = row+'<option value="E">Electricidad</option>';
					row = row+'<option value="EC">Estimacion de Costos</option>';
					row = row+'<option value="G">General</option>';
					row = row+'<option value="GN">Gerencia</option>';
					row = row+'<option value="H">Ambiente e higiene ocupacional</option>';
					row = row+'<option value="I">Instrumentacion</option>';
					row = row+'<option value="M">Mecanica</option>';
					row = row+'<option value="N">Naval</option>';
					row = row+'<option value="O">Geodesia</option>';
					row = row+'<option value="P">Proceso</option>';
					row = row+'<option value="PQ">Procura</option>';
					row = row+'<option value="Q">Calidad</option>';
					row = row+'<option value="T">Telecomunicaciones</option>';
					row = row+'<option value="TB">Tuberias</option>';
				row = row +'</select>';
			row = row +'</td>';
			row = row +'<td>';
				//se le asignara el valor en el success del ajax
					row = row+'<input type="date" readonly class="form-control" id="fecha'+data+'">';
			row = row+'</td>';
		row = row+'</tr>';
	return row;
	}
function buscarCodigo(){
	$("#loader").prop('hidden',true);
	var cod = $("#searchCode").val();

	$.ajax({
		url:'php/lista_maestra/buscar.php',
		data:{codigo:cod},
		dataType:'json',
		method:'POST',
		success:function(data){
			console.log(data)
            if(data != false){
			 $("#codpdvsa"+data).focus();
			 $("#loader").prop('hidden',true);
            }
            else{
                $.alert({
                   title:'No encontrado',
                    content:'Registro no encontrado'
                });
            }
			},
		error:function(xhr,status,error){
			$.alert({
				title:xhr.status,
				content:xhr.status+" "+error
				});
			$("#loader").prop('hidden',true);
			}
		});
	}
function inicio(){
	$("#loader").prop('hidden',false);
	$("#codpdvsa"+ids[0]).focus();
	ub = 0;
	$("#loader").prop('hidden',true);
	$("#numberToShow").val(ub+1);
	}
function fin(){
	$("#loader").prop('hidden',false);
	$("#codpdvsa"+ids[ids.length-1]).focus();
	ub = ids.length - 1;
	$("#loader").prop('hidden',true);
	$("#numberToShow").val(ub+1);
	}
function anterior(){
	$("#loader").prop('hidden',false);
	//se toma el valor de la ultima ubicacion
	//y se le resta 1
	ub = ub - 1;
	if (ub < 0) {
		$.alert({
				title:"Error",
				content:"Intenta seleccionar un registro anterior al primero"
				});
	}
	else//esto sera la ubicacion en el arreglos de los id
		$("#codpdvsa"+ids[ub]).focus();
	$("#numberToShow").val(ub+1);
	$("#loader").prop('hidden',true);
	}
function siguiente(){
	$("#loader").prop('hidden',false);
	//se toma el valor de la ultima ubicacion
	//y se le suma 1
	ub = ub + 1;
	if (ub > ids.length-1) {
		$.alert({
				title:"Error",
				content:"No existen mas registros",
				});
		}
	else
		$("#codpdvsa"+ids[ub]).focus();
	$("#numberToShow").val(ub+1);
	$("#loader").prop('hidden',true);
	}
function limpiar(){
	//finalizado
	$("#loader").prop('hidden',false);
	$('table tbody').find('tr').remove()
	$("#loader").prop('hidden',true)
	}
function actualizar(){
	$("#loader").prop("hidden",false);
		var id = $(this).find("input.value");
		 $.ajax({
		 	url:"php/lista_maestra/actualizar_lista.php",
		 	method:'post',
		 	dataType:'json',
		 	success:function(data){
		 		if (data.Success){
		 		$.alert({
		 			title:'Exito',
		 			content:'Todos los registros mostrados, han sido superados'
		 			});
		 		}
		 		else{
		 			$.alert({
			 			title:'Error',
			 			content:data.Msg+" "+data.Error
			 			});
		 		}
		 	},
		 	error:function(xhr,status,error){
		 		$.alert({
		 			title:'Error',
		 			content:xhr.status+" "+error
		 		});
		 	}
		 });

	$("#loader").prop("hidden",true);
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
function imprimir(){
	//window.location.href ="php/lista_maestra/info.php"
	window.open('php/lista_maestra/info.php','blank');
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

function generarFiltradoPorFecha(){
	console.log($("#desde").val());
	var ruta = "php/lista_maestra/reportByFecha.php?desde="+$("#desde").val()+"&hasta="+$("#hasta").val();
	//window.location.href=ruta;
	window.open(ruta,'blank');
}