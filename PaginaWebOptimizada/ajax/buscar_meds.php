<?php	
	require_once ("../cn/connect2.php"); 	
	$rid =$_POST['rid'];
	$action = (isset($_POST['action'])&& $_POST['action'] !=NULL)?$_POST['action']:'';
	if($action == 'ajax'){
         $qm =$_POST['qm'];
		 $aColumns = array('nombre_medica', 'barras_medica');
		 $sTable = "medicamentos";
		 $sWhere = "";
		if ( $_POST['qm'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$qm."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.="ORDER BY nombre_medica";
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable $sWhere");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM $sTable $sWhere");
		$query->execute();
		if ($numrows>0){		?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<tr>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id_id=$row['id_id_medica'];
						$id=$row['id_medica'];
						$bm=$row['barras_medica'];
						$nm=$row['nombre_medica'];
						$em=$row['envase_medica'];
						$um=$row['unidad_medica'];
						$qty=$row['qtyind_medica'];?>
						<td class="cpoint" onclick="asmedica('<?php echo $id; ?>', '<?php echo $nm; ?>', '<?php echo $bm; ?>', '<?php echo $rid; ?>');"><?php echo $bm; ?></td>
						<td class="cpoint" onclick="asmedica('<?php echo $id; ?>', '<?php echo $nm; ?>', '<?php echo $bm; ?>', '<?php echo $rid; ?>');"><?php echo $nm; ?> -- <?php echo $qty; ?></td>
<?php 	$count_query= $db2->prepare("SELECT nombre_envase AS ne FROM envases WHERE id_envase='$em'");
   		$count_query->execute();
   		for($i=0; $row = $count_query->fetch(); $i++){ $ne= $row['ne'] ;   ?>
						<td class="cpoint" onclick="asmedica('<?php echo $id; ?>', '<?php echo $nm; ?>', '<?php echo $bm; ?>', '<?php echo $rid; ?>');"><?php echo $ne; ?></td>
<?php } 		?>
<?php  	$ct_q= $db2->prepare("SELECT nombre_unidad AS nu FROM unidades WHERE id_unidad='$um'");
   		$ct_q->execute();
  		 	for($i=0; $row = $ct_q->fetch(); $i++){ $nu= $row['nu'] ;   	?>
						<td class="cpoint" onclick="asmedica('<?php echo $id; ?>', '<?php echo $nm; ?>', '<?php echo $bm; ?>', '<?php echo $rid; ?>');"><?php echo $nu; ?></td>
<?php } 		?>											
					</tr>
					<?php } 	 }   }	?>
			  </table>
			</div>