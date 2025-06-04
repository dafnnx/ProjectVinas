<?php
$uid=$_POST['uid'];
	require_once ("../cn/connect2.php"); 	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
         $sta= "1";
		 $aColumns = array('nombre_residente', 'apodo_residente');
		 $sTable = "residentes";
		 $sWhere = "WHERE status_residente='".$sta."'";
		if ( $q != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ") AND status_residente='".$sta."'";
		}
		$sWhere.=" order by nombre_residente";
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable $sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM $sTable $sWhere");
		$query->execute();
		if ($numrows>0){		?>
			<div class="edge">
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>				
					<th class='text-center w60'>*</th>
					<th class='text-center'>Nombre</th>							
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$idr=$row['id_residente'];
						$nr=$row['nombre_residente'];	?>	
					<tr>
						<td><a href="#" class='pnote' title='Notas' onclick="shistdetalles('<?php echo $idr; ?>', '<?php echo $uid; ?>')"></a></td>
						<td><?php echo $nr; ?></td>
					</tr>
					<?php  }	?>
			  </table>
			</div>
			</div>
<?php	} }	?>