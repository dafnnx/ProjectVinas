<?php	require_once ("../cn/connect2.php"); 	 ?>
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
			  	<thead>
				<tr>	
					<th class='text-center'>idrs</th>
					<th class='text-center'>idrr</th>
					<th class='text-center'>status</th>				
				</tr>
				</thead>
				<?php
				$query=$db2->prepare("SELECT DISTINCT id_rresidente AS idrr FROM ropa_residente");
				$query->execute(); 
				for($i=0; $row = $query->fetch(); $i++){
						$idrr=$row['idrr'];		
				

				$query2=$db2->prepare("SELECT MAX(id_ropastatus) AS idrs, MAX(status_ropastatus) AS sta FROM hist_ropastatus WHERE id_rresidente=$idrr  ORDER BY id_ropastatus ASC");
				$query2->execute(); 
				for($i=0; $row = $query2->fetch(); $i++){ $idrs=$row['idrs']; $sta=$row['sta'];

if ($query2) {	
				$queryl=$db2->prepare("UPDATE ropa_residente SET status_ropa='$sta' WHERE id_rresidente=$idrr");
				$queryl->execute(); 
}

							?>	
					<tr>
<td><?php echo $idrs; ?></td>
<td><?php echo $idrr; ?></td>
<td><?php echo $sta; ?></td>								
					</tr>
					<?php




					 }  }	?>
			  </table>
			</div>