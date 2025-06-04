<script type="text/javascript" src="js/residentes.js"></script>
<div class="info gral">
<?php
	require_once ("../cn/connect2.php");	
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM residentes");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM residentes");
		$query->execute(); ?>
		<?php 
		if ($numrows>0){	$nums=1;	?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>
					<th class='text-center pad'>Código</th>
					<th class='text-center'>Nombre</th>
					<th class='text-center'>No. Identificación</th>
					<th class='text-center'>Acciones</th>			
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id=$row['id_residente'];
						$cr=$row['code_residente'];
						$nr=$row['nombre_residente'];
						$ir=$row['nident_residente'];			
					?>
					<tr>
						<td><?php echo $cr; ?></td>	
						<td><?php echo $nr; ?></td>	
						<td><?php echo $ir; ?></td>	
						<td><a href="#" class='del' title='Eliminar' 
							onclick="del('<?php echo $id; ?>', 'residentes', 'id_residente')"></a><a href="#" class='det' title='Detalles' 
							onclick="detalles('<?php echo $id; ?>')"></a></td>				
					</tr>
					<?php	}	?>
			  </table>
			</div>
<?php	}	?>
</div>