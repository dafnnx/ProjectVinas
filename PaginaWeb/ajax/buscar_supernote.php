<?php
$uid=$_POST['uid'];
	require_once ("../cn/connect2.php"); 	
		 $sTable = "nota_supervision";
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM $sTable ORDER BY fecha_notasuper DESC LIMIT 100");
		$query->execute();
		if ($numrows>0){		?>
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>				
					<th class='text-center'>Info</th>
					<th class='text-center'>Observaciones</th>						
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id=$row['id_notasuper'];
						$pid=$row['id_personal'];
						$fec=$row['fecha_notasuper'];
						$tur=$row['turno_notasuper'];
						$obs=$row['obs_notasuper'];
$fnmed = new DateTime($fecha);
$fenfer = $fnmed->format("d-M-Y");
$fenfer2 = $fnmed->format("H:i A");



		$c_query= $db2->prepare("SELECT nombre_personal AS noper FROM personal WHERE id_personal=:pid");
		$c_query->bindParam(':pid', $pid);
		$c_query->execute();
		for($i=0; $row = $c_query->fetch(); $i++){		$noper = $row['noper'];		}		?>	
					<tr>						
						<td class="w12per padd10">
						<div class="linefull">	
							<?php echo $noper; ?>
						</div>
						<div class="linefull">	
							<?php echo $fenfer; ?>
						</div>
						<div class="linefull">	
							<?php echo $fenfer2; ?>
						</div>
						<div class="linefull">
							<?php echo $tur; ?>		
						</div>					
						</td>
						<td>
								<textarea class="tarea99super" rows="5" placeholder="Observaciones" name="evens_turno_notasuper"><?php echo $obs; ?></textarea>						
						</td>
					</tr>
					<?php  }	?>
			  </table>
<?php	} 	?>