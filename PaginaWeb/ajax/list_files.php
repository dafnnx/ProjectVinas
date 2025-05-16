<?php
         $rid =$_POST['rid'];		?>
			<div class="separator"></div>
				<div class="edge">
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>				
					<th class='text-center'>Mis archivos</th>
				</tr>
				</thead>
				<?php
				$j=1;
				$contenido = glob( "../saves/$rid/*" );
				foreach($contenido as $imagen){	
					
						$desg = explode("/", $imagen);
				 ?>	
				<tbody class="bgwhite">	
					<tr>
						<td>
							<div class="nolist"><?php echo $j++; ?></div>
							<a class="tcolor" href="lasvinas/<?php echo $imagen; ?>" target="_blank"><?php echo $desg[3]; ?>
						</td>
					</tr>
				</tbody>	
					<?php }	?>
			  </table>
			</div>
				</div>