<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>
	<?php	if ($ta)  { ?>
		<th class='text-center'>Ta</th>		
	<?php } if ($fc) { ?>	
		<th class='text-center'>Fc</th>	
	<?php } if ($fr) { ?>	
		<th class='text-center'>Fr</th>	
	<?php } if ($sat) { ?>	
		<th class='text-center'>O2</th>	
	<?php } if ($temp) { ?>	
		<th class='text-center'>Temp</th>	
	<?php } if ($gli) { ?>	
		<th class='text-center'>Glicemia</th>	
	<?php } if ($per) { ?>	
		<th class='text-center'>% Comida</th>	
	<?php } if ($can) { ?>	
		<th class='text-center'>Cant. Liq.</th>	
	<?php } if ($nom) { ?>	
		<th class='text-center'>#Micciones</th>	
	<?php } if ($noe) { ?>	
		<th class='text-center'>#Evacua</th>	
	<?php } if ($nop) { ?>	
		<th class='text-center'>#Pañales</th>	
	<?php } if ($vis) { ?>	
		<th class='text-center'>Visita</th>	
	<?php } if ($cai) { ?>	
		<th class='text-center'>Caida</th>	
	<?php } if ($dea) { ?>	
		<th class='text-center'>Deambul</th>	
	<?php } if ($ban) { ?>	
		<th class='text-center'>Baño</th>	
	<?php } if ($buc) { ?>	
		<th class='text-center'>A. Bucal</th>	
	<?php } if ($ter) { ?>	
		<th class='text-center'>T. Fisica</th>	
	<?php }		 ?>					
					<th class='text-center'>Fecha</th>		
				</tr>
				</thead>
				<?php
				for($i=0; $row = $query->fetch(); $i++){
						$ta2=$row['ta_notaenfer'];
						$fc2=$row['fc_notaenfer'];
						$fr2=$row['fr_notaenfer'];
						$sat2=$row['sat_notaenfer'];	
						$temp2=$row['temp_notaenfer'];
						$gli2=$row['gli_notaenfer'];		
						$fec2=$row['fec_notaenfer'];		

						$xfec = new DateTime($fec2);
          				$xfecenfer = $xfec->format("d-M-Y h:i a");

						$perce2=$row['percen_ing_notaenfer'];		
						$cant2=$row['cant_liq_notaenfer'];												
						$nomic2=$row['no_mic_notaenfer'];
						$noevac2=$row['no_evac_notaenfer'];
						$nopanal2=$row['no_panal_notaenfer'];
						$visita2=$row['visita_notaenfer'];
						$caida2=$row['caida_notaenfer'];
						$deam2=$row['deam_notaenfer'];
						$bano2=$row['bano_notaenfer'];
						$bucal2=$row['bucal_notaenfer'];
						$terap2=$row['terap_notaenfer'];

					?>
					<tr>
						<?php	if ($ta)  { ?>
						<td class="textcenter"><?php echo $ta2; ?></td>
						<?php } if ($fc) { ?>
						<td class="textcenter"><?php echo $fc2; ?></td>
						<?php } if ($fr) { ?>	
						<td class="textcenter"><?php echo $fr2; ?></td>
						<?php } if ($sat) { ?>
						<td class="textcenter"><?php echo $sat2; ?></td>	
						<?php } if ($temp) { ?>	
						<td class="textcenter"><?php echo $temp2; ?></td>
						<?php } if ($gli) { ?>	
						<td class="textcenter"><?php echo $gli2; ?></td>	
						<?php } if ($per) { ?>						
						<td class="textcenter"><?php echo $perce2; ?></td>
						<?php } if ($can) { ?>
						<td class="textcenter"><?php echo $cant2; ?></td>
						<?php } if ($nom) { ?>
						<td class="textcenter"><?php echo $nomic2; ?></td>
						<?php } if ($noe) { ?>	
						<td class="textcenter"><?php echo $noevac2; ?></td>	
						<?php } if ($nop) { ?>	
						<td class="textcenter"><?php echo $nopanal2; ?></td>
						<?php } if ($vis) { ?>	
						<td class="textcenter"><?php echo $visita2; ?></td>
						<?php } if ($cai) { ?>
						<td class="textcenter"><?php echo $caida2; ?></td>
						<?php } if ($dea) { ?>
						<td class="textcenter"><?php echo $deam2; ?></td>
						<?php } if ($ban) { ?>	
						<td class="textcenter"><?php echo $bano2; ?></td>
						<?php } if ($buc) { ?>	
						<td class="textcenter"><?php echo $bucal2; ?></td>
						<?php } if ($ter) { ?>	
						<td class="textcenter"><?php echo $terap2; ?></td>
						<?php }		 ?>	
						<td class="textcenter"><?php echo $xfecenfer; ?></td>	
					</tr>
					<?php	} ?>
			  </table>
</div>			