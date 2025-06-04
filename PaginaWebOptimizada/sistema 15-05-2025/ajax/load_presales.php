<?php
if (isset($_POST['uid'])) {
	$uid=$_POST['uid'];
}
	require_once ("../cn/connect2.php"); 	
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $q =$_POST['q'];
         $sta= "3";
		 $aColumns = array('nombre_residente');
		 $sTable = "presales";
		 $sWhere = "WHERE status='".$sta."'";
		if ( $q != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ") AND status='".$sta."'";
		}
		$sWhere.=" order by presale_id";
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
					<th class='text-center'>Residente</th>	
					<th class='text-center'>Fecha</th>					
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$sid=$row['presale_id'];
						$uid=$row['id_usuario'];
						$idr=$row['id_residente'];
						$nom=$row['nombre_residente'];
						$fec=$row['fecha'];	?>	
					<tr>
						<td>
							<div class="del" onclick="delsalepre('<?php echo $sid; ?>', '<?php echo $uid; ?>')" title='Eliminar'></div>
							<a class='icnsale' title='Notas' onclick="dets('<?php echo $sid; ?>', '<?php echo $uid; ?>', '<?php echo $idr; ?>')"></a>							
						</td>
						<td><?php echo $nom; ?></td>			
						<td><?php echo $fec; ?></td>
					</tr>
					<?php  }	?>
			  </table>
			</div>
<?php	} }	?>