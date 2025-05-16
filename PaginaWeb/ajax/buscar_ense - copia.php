<?php	
	require_once ("../cn/connect2.php"); 	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
		 $aColumns = array('nombre_residente', 'apodo_residente', 'marca_ropa', 'nombre_ropa');
		 $sTable = "ropa_residente";
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
		$sWhere.="ORDER BY apodo_residente ASC";
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable $sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM $sTable $sWhere LIMIT 250");
		$query->execute();
		if ($numrows>0){		?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>		
					<th class='text-center'>*</th>
					<th class='text-center'>Apodo</th>	
					<th class='text-center'>Fecha</th>	
					<th class='text-center'>Nombre</th>
					<th class='text-center'>Talla</th>
					<th class='text-center'>Marca</th>
					<th class='text-center'>Observa</th>							
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
						$ir=$row['ingreso_ropa'];							?>	
					<tr>
<td><a class='del' title='Eliminar' onclick="eliminar('<?php echo $idr; ?>', 'ropa_residente', 'id_rresidente', '<?php echo $ida; ?>')"></a></td>
<?php
	   if (!$apo) {	?>	<td>N/A</td>	
<?php } else { ?>	<td class="nrlimit"><?php echo $apo; ?></td>  <?php   }	?>
					<td class="nrlimit"><?php	 $fecha = new DateTime($ir);  $cadfe = $fecha->format("d-M-Y");  echo $cadfe;?>	</td>
<?php  if (!$nr) {	?>	<td>N/A</td>	
<?php } else { ?>	<td class="nrlimit"><?php echo $nr; ?></td>
<?php }	if (!$tr) {	?>	<td>N/A</td>	
<?php } else { ?>	<td><?php echo $tr; ?></td>
<?php } if (!$mr) {	?>	<td>N/A</td>								
<?php } else { 	?>	<td><?php echo $mr; ?></td>
<?php   }	?>
					<td title="<?php echo $or; ?>"><?php echo $or; ?></td>											
					</tr>
					<?php   }	?>
			  </table>
			</div>
<?php	} }	 ?>