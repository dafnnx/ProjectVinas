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
		$sWhere.=" order by nombre_medica";
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable $sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM $sTable $sWhere");
		$query->execute();
		if ($numrows>0){		?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>
					<th class='text-center w60'>*</th>	
					<th class='text-center'>ID</th>
					<th class='text-center'>CVE SAE</th>				
					<th class='text-center'>Código de Barras</th>				
					<th class='text-center'>Nombre</th>
					<th class='text-center'>Prod. Sanitario</th>
					<th class='text-center'>Unidosis</th>
					<th class='text-center'>Cabe Dispensario</th>
					<th class='text-center'>Necesita Frío</th>
					<th class='text-center'>Envase</th>
					<th class='text-center'>Unidad</th>
					<th class='text-center'>Presentación</th>
					<th class='text-center'>Cantidad Ind.</th>
					<th class='text-center'>Stock</th>
					<th class='text-center'>Clave SAT</th>
					<th class='text-center'>Observaciones</th>					      						
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id_id= $row['id_id_medica'];
						$id= $row['id_medica'];
						$cve_sae= $row['cve_sae'];
          				$barras= $row['barras_medica'];
          				$nombre= $row['nombre_medica'];
          				$sani= $row['sani_medica'];
          				$unidosis= $row['unidosis_medica'];
          				$cabedisp= $row['cabedisp_medica'];
          				$frio= $row['frio_medica'];
          				$envase= $row['envase_medica'];
          				$unidad= $row['unidad_medica'];
          				$presenta= $row['presenta_medica'];
          				$qty= $row['qtyind_medica'];
          				$stock= $row['stock_medica'];
          				$clave_sat= $row['clave_sat'];
          				$observa= $row['observa_medica'];
					?>
					<tr>
						<td>
							<a href="#" class='del' title='Eliminar' onclick="eliminar('<?php echo $id; ?>', 'medicamentos', 'id_id_medica')"></a>
							<a href="#" class='det' title='Detalles' onclick="detalles('<?php echo $id_id; ?>', '<?php echo $id; ?>')"></a>
						</td>
						<td><?php echo $id; ?></td>
						<td><?php echo $cve_sae; ?></td>
						<td><?php echo $barras; ?></td>
						<td><?php echo $nombre; ?></td>
						<td><?php echo ($sani == 'si') ? 'Sí' : 'No'; ?></td>
						<td><?php echo ($unidosis == 'si') ? 'Sí' : 'No'; ?></td>
						<td><?php echo ($cabedisp == 'si') ? 'Sí' : 'No'; ?></td>
						<td><?php echo ($frio == 'si') ? 'Sí' : 'No'; ?></td>
						<td><?php echo $envase; ?></td>
						<td><?php echo $unidad; ?></td>
						<td><?php echo $presenta; ?></td>
						<td><?php echo $qty; ?></td> 
						<td><?php echo $stock; ?></td>
						<td><?php echo $clave_sat; ?></td>
						<td><?php echo substr($observa, 0, 50) . (strlen($observa) > 50 ? '...' : ''); ?></td>						                  						
					</tr>
					<?php	}	?>
			  </table>
			</div>
<?php	} }	?>