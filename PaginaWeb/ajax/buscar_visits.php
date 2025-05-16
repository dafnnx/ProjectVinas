<?php
$uid=69;
	require_once ("../cn/connect2.php"); 	
         $q =$_POST['q'];
         $sTable = "residentes";
         $sta= "1";
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM $sTable");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM $sTable LIMIT 20");
		$query->execute();
		if ($numrows>0){		?>
			<div class="edge">
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>				
					<th class='text-center'>Nombre</th>							
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$idr=$row['id_residente'];
						$nr=$row['nombre_residente'];	?>	
					<tr>
						<td><?php echo $nr; ?></td>
					</tr>
					<?php  }	?>
			  </table>
			</div>
			</div>
<?php	} 	?>