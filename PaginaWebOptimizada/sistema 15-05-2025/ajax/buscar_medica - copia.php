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
					<th class='text-center'>Barras</th>				
					<th class='text-center'>Nombre</th>						
					<th class='text-center'>Cantidad ind</th>
					<th class='text-center'>Stock</th>				      						
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id_id= $row['id_id_medica'];
						$id= $row['id_medica'];
          				$barras= $row['barras_medica'];
          				$nombre= $row['nombre_medica'];
          				$qty= $row['qtyind_medica'];
          				$stock= $row['stock_medica'];	
					?>
					<tr>
						<td>
							<a href="#" class='del' title='Eliminar' onclick="eliminar('<?php echo $id; ?>', 'medicamentos', 'id_id_medica', '<?php echo $uid; ?>')"></a>
							<a href="#" class='det' title='Detalles' onclick="detalles('<?php echo $id_id; ?>', '<?php echo $id; ?>')"></a>
						</td>
						<td><?php echo $barras; ?></td>
						<td><?php echo $nombre; ?></td> 						 
						<td><?php echo $qty; ?></td> 
						<td><?php echo $stock; ?></td> 						                  						
					</tr>
					<?php	}	?>
			  </table>
			</div>
<?php	} }	?>