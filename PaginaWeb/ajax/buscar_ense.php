<?php	
	require_once ("../cn/connect2.php"); 	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
		 // Actualizamos las columnas para incluir el prefijo de tabla
		 $aColumns = array('rr.nombre_residente', 'rr.apodo_residente', 'rr.marca_ropa', 'rr.nombre_ropa');
		 
		 // Cambiamos la tabla para incluir JOIN con residentes
		 $sTable = "ropa_residente rr INNER JOIN residentes r ON rr.id_residente = r.id_residente";
		 
		 // Empezamos el WHERE con el filtro de status
		 $sWhere = "WHERE r.status_residente = 1";
		 
		if ( $_POST['q'] != "" )
		{
			$sWhere .= " AND (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" ORDER BY rr.apodo_residente ASC";
		
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable $sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		
		// Seleccionamos todos los campos de ropa_residente + campos de residentes para debug - SIN LIMIT
		$query=$db2->prepare("SELECT rr.*, r.status_residente, r.nombre_residente, r.id_residente, r.curp_residente FROM $sTable $sWhere");
		$query->execute();
		
		if ($numrows>0){		?>
			<div class="">
			  <table class="table table-striped table-condensed" data-responsive="table" id="resultTable" style="font-size: 11px;">
			  	<thead>
				<tr>		
					<th class='text-center'>*</th>
					<th class='text-center'>Apodo</th>
					<th class='text-center'>Nombre Completo</th>	
					<th class='text-center'>Fecha</th>	
					<th class='text-center'>Prenda</th>
					<th class='text-center'>Talla</th>
					<th class='text-center'>Marca</th>
					<th class='text-center'>Observa</th>
					<th class='text-center'>Status Residente</th>							
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$apo=$row['apodo_residente'];
						$nr=$row['nombre_ropa'];
						$tr=$row['talla_ropa'];
						$mr=$row['marca_ropa'];	
						$or=$row['observa_ropa'];
						$ir=$row['ingreso_ropa'];
						$status_debug=$row['status_residente']; // Para debug
						$nombre_completo=$row['nombre_residente']; // Nombre completo de residentes
												?>	
					<tr>
<td><a class='del' title='Eliminar' onclick="eliminar('<?php echo $idr; ?>', 'ropa_residente', 'id_rresidente', '<?php echo $ida; ?>')"></a></td>
					
<?php
	   if (!$apo) {	?>	<td>N/A</td>	
<?php } else { ?>	<td class="nrlimit"><?php echo $apo; ?></td>  <?php   }	?>
					<td class="nrlimit"><?php echo $nombre_completo; ?></td>
					<td class="nrlimit"><?php	 $fecha = new DateTime($ir);  $cadfe = $fecha->format("d-M-Y");  echo $cadfe;?>	</td>
<?php  if (!$nr) {	?>	<td>N/A</td>	
<?php } else { ?>	<td class="nrlimit"><?php echo $nr; ?></td>
<?php }	if (!$tr) {	?>	<td>N/A</td>	
<?php } else { ?>	<td><?php echo $tr; ?></td>
<?php } if (!$mr) {	?>	<td>N/A</td>								
<?php } else { 	?>	<td><?php echo $mr; ?></td>
<?php   }	?>
					<td title="<?php echo $or; ?>"><?php echo $or; ?></td>
					<td><strong style="color: <?php echo ($status_debug == 1) ? 'green' : 'red'; ?>;"><?php echo $status_debug; ?></strong></td>											
					</tr>
					<?php   }	?>
			  </table>
			</div>
<?php	} }	 ?>