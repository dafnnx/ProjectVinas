<?php	
$rid =$_POST['rid']; 

		require_once ("../cn/connect2.php"); 	
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM ropa_residente WHERE id_residente=:rid AND status_ropa='activo'");
		$count_query->bindParam(':rid', $rid);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM ropa_residente WHERE id_residente=:rid AND status_ropa='activo' ORDER BY id_rresidente DESC");
		$query->bindParam(':rid', $rid);
		$query->execute();
		if ($numrows>0){		?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>	
					<th class='text-center'>Nombre</th>
					<th class='text-center'>Talla</th>
					<th class='text-center'>Marca</th>
					<th class='text-center'>Color</th>
					<th class='text-center'>Observa</th>
					<th class='text-center'>Fecha</th>
					<th class='text-center'>Condición</th>					
					<th class='text-center'>*</th>						
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$idr=$row['id_rresidente'];
						$ida=$row['id_armario'];
						$apo=$row['apodo_residente'];
						$nr=$row['nombre_ropa'];
						$tr=$row['talla_ropa'];
						$mr=$row['marca_ropa'];	
						$or=$row['observa_ropa'];
						$ir=$row['ingreso_ropa'];
						$cr=$row['color_ropa'];	
						$er=$row['estado_ropa'];
						$star=$row['status_ropa'];							?>	
					<tr>
<?php  if (!$nr) {	?>	<td>N/A</td>	<?php } else { ?>	<td><?php echo $nr; ?></td><?php   }	?>
<?php  if (!$tr) {	?>	<td>N/A</td>    <?php } else { ?>	<td><?php echo $tr; ?></td><?php   }	?>
<?php  if (!$mr) {	?>	<td>N/A</td>	<?php } else { ?>	<td><?php echo $mr; ?></td><?php   }	?>
<?php  if (!$cr) {	?>	<td>N/A</td>	<?php } else { ?>	<td><input type="color" name="ense3" disabled value="<?php echo $cr; ?>" title="Color"></td><?php   }	?>
															<td title="<?php echo $or; ?>"><?php echo $or; ?></td>	
															<td ><?php	 $fecha = new DateTime($ir);  $cadfe = $fecha->format("d-M-Y");  echo $cadfe;?>	</td>
<?php  if (!$er) {	?>	<td>N/A</td>	<?php } else { 	?>	<td><?php echo $er; ?></td><?php   }	?>	
					<td><a class='del' title='Eliminar' onclick="eliminar_ens('<?php echo $idr; ?>', 'ropa_residente', 'id_rresidente', '<?php echo $rid; ?>')"></a></td>									
					</tr>
					<?php   }	?>
			  </table>
			</div>
<?php	} else {		echo "Sin enseres Activos";   	} ?>