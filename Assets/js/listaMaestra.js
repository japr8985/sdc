function cargar_lista_maestra(){
	$("#loader").prop('hidden',false);
	$.ajax({
		url:'php/lista_maestra/lista_maestra.php',
		method:'POST',
		dataType:'json',
		success:function(data){
			//limpiar contenido de la lista maestra
			$('#listaMaestra').empty()
			console.log(data);
			console.log(typeof(data[0][6])+'/'+data[0][6]+'/'+(!data[0][6]));
			//creando nuevo contenido para la lista
			for (var i = 0; i < data.length; i++) {
				//agregando filas a la tabla
				$("table tbody").append(row(data[i][0]));
				$("#codpdvsa"+data[i][0]).val(data[i][1]);
				$("#descripcion"+data[i][0]).val(data[i][2]);
				$("#rev"+data[i][0]).val(data[i][3]);
				$("#fase"+data[i][0]).val(data[i][4]);
				$("#disciplina"+data[i][0]).val(data[i][5]);
				if (data[i][6] != null) 
					$("#fecha"+data[i][0]).val(data[i][6]);
				}
			$("#loader").prop('hidden',true);
			//habilitando boton de busqueda
			$("#btnSearch").prop('disabled',false);
			//habilitando input de busqueda
			$("#searchCode").prop('disabled',false);
			},
		error:function(xhr,status,error){
			$.alert({
				title:xhr.status,
				content:xhr.status+" "+thrownError
				});
			$("#loader").prop('hidden',true);
			}
		});
	}

function row(data){
	//funcion para dibujar la fila del registro creando un id para cada elemento unico segun su id en la db
	var row ='<tr>';
			row = row+'<td>';
				row = row+'<input class="form-control" type="hidden" value="'+data+' id="cod'+data+'">';
			row = row+'</td>';
			row = row+'<td>';
				row = row+'<input class="form-control" type="text" id="codpdvsa'+data+'">';
			row = row+'</td>';
			row = row+'<td>';
				row = row+'<input class="form-control" type="text" id="descripcion'+data+'">';
			row = row+'</td>';
			row = row+'<td>';
				row = row+'<input class="form-control" type="text" id="rev'+data+'" style="width:60px;">';
			row = row+'</td>';
			row = row +'<td>';
			//al id del select se le concatena el id del registro para distinguirlo de los demas
			//y asignarle el valor en el success del ajax
				row = row +'<select class="form-control" style="width: 110px;" id="fase'+data+'">';
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
				row = row +'<select class="form-control" style="width: 100px;" id="disciplina'+data+'">';
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
					row = row+'<input type="date" class="form-control" id="fecha'+data+'">';
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
			$("#codpdvsa"+data).focus();
			$("#loader").prop('hidden',true);
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