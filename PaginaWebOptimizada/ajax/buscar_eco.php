<?php
	require_once ("../cn/connect2.php"); 	
$them= date("Y-m");
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
					<th class='text-center w95'>*</th>
					<th class='text-center'>Nombre</th>
					<th class='text-center'>Adeudo conceptos</th>	
					<th class='text-center'>Adeudo del mes</th>
					<th class='text-center'>Cuota del mes</th>								
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$idr=$row['id_residente'];
						$nr=$row['nombre_residente'];
						$tr=$row['tarifa_residente'];	 ?>	
					<tr>
						<td><a href="#" class='acco' title='Detalles' onclick="accdetalles('<?php echo $idr; ?>', '<?php echo $nr; ?>')"></a>
							<a href="#" class='ejer' title='Ejercicios' onclick="accejers('<?php echo $idr; ?>', '<?php echo $nr; ?>')"></a>
							<a href="#" class='data' title='Edicion' onclick="accdata('<?php echo $idr; ?>')"></a>
						</td>
						<td><?php echo $nr; ?></td>
<?php 
		$_query= $db2->prepare("SELECT SUM(debe_pay) AS dbp, SUM(aporta_pay) AS app FROM payconcept WHERE id_residente=:idr");
		$_query->bindParam(':idr', $idr);
		$_query->execute();
		for($i=0; $row = $_query->fetch(); $i++){
		$dbp = $row['dbp'];
		$app = $row['app']; 	
		$adg = $dbp-$app; }

		if ($adg) { ?>
				<td>$<?php echo number_format($adg, 2); ?></td>
<?php			}  	else 	{ ?>
			<td>N/A</td>
<?php 	}
    $coun= $db2->prepare("SELECT SUM(abono_tarifa) AS cpm FROM tarifas WHERE id_residente=:idr AND fecha_tarifa=:them");
    $coun->bindParam(':idr', $idr);
    $coun->bindParam(':them', $them);
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){ 
     $cpm= $row['cpm'];	
     	if ($cpm) { ?>
     		<td>$<?php echo number_format($cpm, 2); ?></td>
     <?php 	} 	else  {       ?>
						<td>N/A</td>
<?php 	} 	}
if ($tr) {	?>
	<td>$<?php echo number_format($tr, 2); ?></td>
<?php 	}	else {	?>						
						<td>N/A</td>
<?php 	 }	?>
					</tr>
					<?php }	?>
			  </table>
			</div>
				</div>
<?php	} }		?>