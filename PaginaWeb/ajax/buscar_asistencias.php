<div class="info gral">
<?php
$pid=$_POST['pid'];
	require_once ("../cn/connect2.php");	
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM asistencias WHERE id_personal=:pid");
		$count_query->bindParam(':pid', $pid);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM asistencias WHERE id_personal=:pid");
		$query->bindParam(':pid', $pid);
		$query->execute(); ?>
		<?php 
		if ($numrows>0){	?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>
					<th class='text-center pad'>Residente</th>
					<th class='text-center'>Fecha</th>		
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$idr=$row['id_residente'];
						$fec=$row['fecha_asistencia'];		
					?>
					<tr>
<?php 	$ry=$db2->prepare("SELECT nombre_residente AS nom FROM residentes WHERE id_residente=:idr");
		$ry->bindParam(':idr', $idr);
		$ry->execute();
		for($i=0; $row = $ry->fetch(); $i++){
		$nom = $row['nom']; ?>
						<td><?php echo $nom; ?></td>	
<?php } ?>
						<td><?php echo $fec; ?></td>				
					</tr>
					<?php	}	?>
			  </table>
			</div>
<?php	}	?>
</div>