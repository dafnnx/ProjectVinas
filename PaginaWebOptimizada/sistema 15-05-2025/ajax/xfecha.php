<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>
					<th class='text-center'>Ticket</th>
					<th class='text-center'>Fecha</th>					
					<th class='text-center'>Concepto</th>
					<th class='text-center'>Cantidad</th>
					<th class='text-center'>Total</th>				
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$id_venta=$row['sale_id'];
						$fecha=$row['fecha_pay'];
						$concepto=$row['concept_pay'];
						$qty=$row['cantidad_pay'];	
						$debe=$row['debe_pay'];
						$iva=$row['iva_pay'];	
						if ($iva) {	$debeiva=$debe+$iva;	}
						else {	$debeiva=$debe;	}													
					?>
					<tr>
						<td><?php echo $id_venta; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo $concepto; ?></td>
						<td><?php echo $qty; ?></td>	
						<td>$ <?php echo number_format($debeiva, 2); ?></td>	
					</tr>
					<?php	} ?>
			  </table>
			  <div class="botonera3">
			  	<div class="result">Total: $<?php echo number_format($tot, 2);?></div>	
			  </div>
</div>			