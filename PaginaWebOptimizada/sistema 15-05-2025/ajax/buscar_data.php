<?php
	require_once ("../cn/connect2.php"); 	
         $idr =$_POST['idr'];
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM payconcept WHERE id_residente=:idr");
		$count_query->bindParam(':idr', $idr);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];}
		$query=$db2->prepare("SELECT * FROM payconcept WHERE id_residente=:idr ORDER BY fecha_pay ASC");
		$query->bindParam(':idr', $idr);
		$query->execute();
		if ($numrows>0){		?>
			<div class="separator"></div>
				<div class="edge">
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>				
					<th class='text-center'>Id pago</th>
					<th class='text-center'>Fecha capturada</th>	
					<th class='text-center'>Id concepto</th>
					<th class='text-center'>Concepto</th>
					<th class='text-center'>Debe</th>			
					<th class='text-center'>Aporta</th>
					<th class='text-center'>IVA</th>
					<th class='text-center'>Fecha de captura</th>
					<th class='text-center'>Persona</th>
					<th class='text-center'>Cantidad</th>
					<th class='text-center'>Status</th>
					<th class='text-center'>Id Venta</th>
					<th class='text-center'>*</th>
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$idp=$row['id_pay'];
						$fec=$row['fecha_pay'];	
						$idcp=$row['idconcept_pay'];
						$cp=$row['concept_pay'];
						$deb=$row['debe_pay'];
						$apo=$row['aporta_pay'];
						$apo=$row['aporta_pay'];
						$iva=$row['iva_pay'];
						$reg=$row['reg_pay'];
						$per=$row['persona_pay'];
						$cant=$row['cantidad_pay'];	
						$sta=$row['status'];
						$vta=$row['sale_id'];	 ?>	
				<tbody class="bgwhite">	
					<tr>
						<td><?php echo $idp; ?></td>
						<td>							
<input type="text" class="ed_input w120" onblur="r_live_up('<?php echo $idp; ?>', 'fecha_pay', this.value, 'payconcept', 'id_pay', '<?php echo $fec; ?>');" value="<?php echo $fec; ?>">
						</td>
						<td><?php echo $idcp; ?></td>
						<td>
<input type="text" class="ed_input w250" onblur="r_live_up('<?php echo $idp; ?>', 'concept_pay', this.value, 'payconcept', 'id_pay', '<?php echo $cp; ?>');" value="<?php echo $cp; ?>">	
						</td>
						<td>
<input type="text" class="ed_input w60" onblur="r_live_up('<?php echo $idp; ?>', 'debe_pay', this.value, 'payconcept', 'id_pay', '<?php echo $deb; ?>');" value="<?php echo $deb; ?>">
						</td>
						<td>
<input type="text" class="ed_input w60" onblur="r_live_up('<?php echo $idp; ?>', 'aporta_pay', this.value, 'payconcept', 'id_pay', '<?php echo $apo; ?>');" value="<?php echo $apo; ?>">
						</td>
						<td><?php echo $iva; ?></td>
						<td><?php echo $reg; ?></td>
						<td>
<input type="text" class="ed_input w250" onblur="r_live_up('<?php echo $idp; ?>', 'persona_pay', this.value, 'payconcept', 'id_pay', '<?php echo $per; ?>');" value="<?php echo $per; ?>">
						</td>
						<td><?php echo $cant; ?></td>
						<td><?php echo $sta; ?></td>
						<td><?php echo $vta; ?></td>
<td>
						<a href="#" class='del' title='Detalles' onclick="dele('<?php echo $idp; ?>', '<?php echo $idr; ?>')"></a>
</td>
					</tr>
				</tbody>	
					<?php }	?>
			  </table>
			</div>
				</div>
<?php	} 	?>