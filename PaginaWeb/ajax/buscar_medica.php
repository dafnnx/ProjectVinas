<?php
	require_once ("../cn/connect2.php"); 	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
		 $aColumns = array('barras_medica', 'nombre_medica');
		 $sTable = "medicamentos";
		 $sWhere = "";
		if ( $_POST['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by m.nombre_medica";
		
		// Consulta optimizada para el conteo sin JOINs innecesarios
		$count_sWhere = str_replace('m.', '', $sWhere);
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable $count_sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		
		// Consulta principal optimizada con LIMIT para paginación
	$query=$db2->prepare("SELECT m.*, 
                          p.nombre_presentacion,
                          e.nombre_envase,
                          u.nombre_unidad,
                          (SELECT GROUP_CONCAT(a.nombre_activo SEPARATOR ', ') 
                           FROM rel_act_med ram 
                           JOIN activos a ON ram.id_activo = a.id_activo 
                           WHERE ram.id_medica = m.id_medica) as principios_activos 
                      FROM $sTable m 
                      LEFT JOIN presentaciones p ON m.presenta_medica = p.id_presentacion
                      LEFT JOIN envases e ON m.envase_medica = e.id_envase
                      LEFT JOIN unidades u ON m.unidad_medica = u.id_unidad
                      $sWhere 
                      LIMIT 100");
		$query->execute();
		if ($numrows>0){		?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr> 
					<th class='text-center w60'>*</th>	
					<th class='text-center'>ID</th>
					<th class='text-center'>Código de Barras</th>				
					<th class='text-center'>Nombre Comercial</th>
					<th class='text-center'>Principio Activo</th>
					<th class='text-center'>Concentración</th>
					<th class='text-center'>Unidad Médica</th>

					<th class='text-center'>Presentación</th>
					<th class='text-center'>Cantidad</th>
					<th class='text-center'>Forma Farmacéutica</th>
					<th class='text-center'>Stock</th>
					<th class='text-center'>Observaciones</th>					      						
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id_id= $row['id_id_medica'];
						$id= $row['id_medica'];
						$cve_sae= $row['cve_sae'];
          				$barras= $row['barras_medica'];
          				$nombre= $row['nombre_medica']; // Nombre Comercial
          				$sani= $row['sani_medica'];
          				$unidosis= $row['unidosis_medica'];
          				$cabedisp= $row['cabedisp_medica'];
          				$frio= $row['frio_medica'];
          				$envase= $row['envase_medica']; // Forma Farmacéutica
          				$unidad= $row['unidad_medica'];
						$unidad_medica = $row['nombre_unidad'] ?: 'N/A';
          				$presenta= $row['nombre_presentacion'] ?: 'N/A'; // Nombre de presentación
          				$nombre_envase= $row['nombre_envase'] ?: 'N/A'; // Nombre del envase
          				$qty= $row['qtyind_medica']; // Cantidad
          				$stock= $row['stock_medica'];
          				$clave_sat= $row['clave_sat'];
          				$observa= $row['observa_medica']; // Observaciones
          				$mililitros= $row['mililitros_medica']; // Concentración
          				$principio_activo = $row['principios_activos'] ?: 'N/A'; // Principios activos
					?>
					<tr>
						<td>
							<a href="#" class='del' title='Eliminar' onclick="eliminar('<?php echo $id; ?>', 'medicamentos', 'id_id_medica')"></a>
							<a href="#" class='det' title='Detalles' onclick="detalles('<?php echo $id_id; ?>', '<?php echo $id; ?>')"></a>
						</td>
						<td><?php echo $id; ?></td>
						<td><?php echo $barras; ?></td>
						<td><?php echo $nombre; ?></td>
						<td><?php echo $principio_activo; ?></td>
						<td><?php echo ($mililitros !== null) ? $mililitros . ' ' : 'N/A'; ?></td>
						<td><?php echo $unidad_medica; ?></td>

						<td><?php echo $presenta; ?></td>
						<td><?php echo $qty; ?></td>
						<td><?php echo $nombre_envase; ?></td>
						<td><?php echo $stock; ?>
						<td><?php echo substr($observa, 0, 50) . (strlen($observa) > 50 ? '...' : ''); ?></td>						                  						
					</tr>
					<?php	}	?>
			  </table>
			</div>
<?php	} }	?>