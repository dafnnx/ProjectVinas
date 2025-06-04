<?php 
	  require_once ("../cn/connect2.php");
	  $idr= $_POST['idr'];	

		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM payconcept WHERE id_residente=:id");
		$count_query->bindParam(':id', $idr);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}

	  	$query=$db2->prepare("SELECT * FROM payconcept WHERE id_residente=:id ORDER BY fecha_pay DESC");
		$query->bindParam(':id', $idr);
		$query->execute();	
if ($numrows>0){		?>
			<div class="edge">
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>		
					<th class='text-center'>Nombre</th>
					<th class='text-center'>Cantidad</th>
					<th class='text-center'>Fecha</th>												
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
					$cons= $row['concept_pay'];
					$fecha= $row['fecha_pay'];
					$qty= $row['cantidad_pay'];	?>	
					<tr>
						<td><?php echo $cons; ?></td>
						<td><?php echo $qty; ?></td>						
						<td><?php echo $fecha; ?></td>						
					</tr>
					<?php  }	?>
			  </table>
			</div>
			</div>
<?php	} else {
      echo "<span class='disponible'> El residente no tiene preventas.</span>";
  } 	?>