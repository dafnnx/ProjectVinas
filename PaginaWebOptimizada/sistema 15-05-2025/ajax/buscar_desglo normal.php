<?php
$idr=$_POST['idr'];
$fec=$_POST['fec'];
	require_once ("../cn/connect2.php"); 	
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM tratamientos WHERE id_residente=:idr");
		$count_query->bindParam(':idr', $idr);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM tratamientos WHERE id_residente=:idr AND status_tratamiento=1");
		$query->bindParam(':idr', $idr);
		$query->execute();
		if ($numrows>0){		?>
			<div class="edge">
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$idt=$row['id_tratamiento'];
						$med=$row['med_tratamiento'];
						$siet=$row['siet_tratamiento'];
						$och=$row['och_tratamiento'];
						$trce=$row['trce_tratamiento'];
						$dieco=$row['dieco_tratamiento'];
						$vtuno=$row['vtuno_tratamiento'];	?>
					<tr>
						<td><?php echo $med; ?></td>
						<td><?php echo $siet; ?></td>
						<td><?php echo $och; ?></td>
						<td><?php echo $trce; ?></td>
						<td><?php echo $dieco; ?></td>
						<td><?php echo $vtuno; ?></td>
						
					</tr>
					<?php }	?>
			  </table>
			</div>
			</div>
<?php	} 	?>