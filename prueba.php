
	<button onClick="cargar_lista_maestra()">Cargar lista Maestra</button>
		<table id="listaMaestra" class="table table-hoverable">
			<thead>
				<tr>
					<td></td>
					<td>Codigo PDVSA</td>
					<td>Descripcion</td>
					<td>Revision</td>
					<td>Fase</td>
					<td>Disciplina</td>
					<td>Fecha de Revision/Emision</td>
				</tr>
			</thead>
			<div id="listaMaestraBox">
				<tbody>
				<?php while ($l = $listas->fetch_array()): ?>
					<tr>
						<td>
							<input type="hidden" id="cod" value="<?php echo $l[0] ?>">
						</td>
						<td>
							<input type="text" id="codpdvsa" class="form-control" value="<?php echo $l[1]; ?>">
						</td>
						<td>
							<input type="text" id="descripcion" class="form-control" value="<?php echo utf8_encode($l['descripcion']); ?>">
						</td>
						<td>
							<input type="text" id="revision" class="form-control" value="<?php echo $l[3]; ?>">
						</td>
						<td>
							<select name="fase" id="fase" class="form-control">
								<?php while($f = $fases->fetch_array()): ?>
								<option value="<?php echo $f[0]; ?>"><?php echo $f[1]; ?></option>
							<?php  endwhile;?>
							</select>
						</td>
						<td>
							<select name="disciplina" id="disciplina" class="form-control">
								<?php while($r = $query->fetch_array()): ?>
									<option value="<?php echo $r[1]; ?>"><?php echo $r[0]; ?></option>
								<?php endwhile; ?>
							</select>
						</td>
						<td>
						<?php $fecha = ($l['fecha'] != null) ? new DateTime($l['fecha']) : ''; ?>
						<?php if ($fecha !=''): 
								$fecha = $fecha->format('Y-m-d');
						endif ?>
							<input type="date" id="fecha" class="form-control" value="<?php echo $fecha; ?>">
						</td>
					</tr>
				<?php endwhile; ?>
				</tbody>
			</div>
		</table>