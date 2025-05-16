<?php	
	require_once ("../cn/connect2.php"); 	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
         $sta= "1";
		 $aColumns = array('nombre_prospecto');
		 $sTable = "prospectos";
		 $sWhere = "WHERE status_prospecto='".$sta."'";
		if ( $q != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ") AND status_prospecto='".$sta."'";
		}
		$sWhere.="ORDER BY nombre_prospecto";
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
					<th class='text-center w90'>*</th>
					<th class='text-center'>Nombre</th>
					<th class='text-center'>Curp</th>	
					<th class='text-center pad'>Alta</th>	
					<th class='text-center pad'>Seguimiento</th>										
				</tr>
				</thead>
<tbody class="111">
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id=$row['id_prospecto'];
						$nr=$row['nombre_prospecto'];
						$cr=$row['curp_prospecto'];	
						$fe=$row['fecha_prospecto'];
						$seg=$row['seguimiento_prospecto'];	?>	
					<tr>
						<td><a href="#" class='del' title='Eliminar' onclick="eliminar('<?php echo $id; ?>', 'prospectos', 'id_prospecto', '<?php echo $uid; ?>')"></a>	
							<a href="#" class='det' title='Detalles' onclick="detalles('<?php echo $id; ?>', '<?php echo $uid; ?>')"></a>
							<a href="#" class='tra' title='Transferir' onclick="transfer('<?php echo $id; ?>', '<?php echo $uid; ?>')"></a>
						</td>
						<td><?php echo $nr; ?></td>
						<td><?php echo $cr; ?></td>	
						<td><?php echo $fe; ?></td>	
						<td><?php echo $seg; ?></td>													
					</tr>					
					<?php    }	?>
</tbody>
			  </table>
			</div>
<?php	} }	?>