<?php
$idr=$_POST['idr'];
$fec=$_POST['fec'];
$hou=$_POST['hou'];
	require_once ("../cn/connect2.php"); 	
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM tratamientos WHERE id_residente=:idr");
		$count_query->bindParam(':idr', $idr);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){		$numrows = $row['numrows'];			}
		if ($numrows>0){

$aColumns=explode(",",$hou);
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{				$sWhere .= $aColumns[$i]."  >0 OR ";			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
				?>
			<div class="edge">
			<div class="">
			  <table class="table" data-responsive="table" id="resultTable">
				<?php
				$query=$db2->prepare("SELECT * FROM tratamientos $sWhere AND id_residente=:idr");
				$query->bindParam(':idr', $idr);
				$query->execute();
				for($i=0; $row = $query->fetch(); $i++){
						$idt=$row['id_tratamiento'];
						$med=$row['med_tratamiento'];
						$siet=$row['siet_tratamiento'];
						$och=$row['och_tratamiento'];
						$trce=$row['trce_tratamiento'];
						$dieco=$row['dieco_tratamiento'];
						$vtuno=$row['vtuno_tratamiento'];
						$unidad=$row['unidad_medicamento'];	?>
					<tr>
						<td class="w300"></td>
						<td class="w300"><?php
				$quey=$db2->prepare("SELECT nombre_medica AS nmed FROM medicamentos WHERE id_medica=:med");
				$quey->bindParam(':med', $med);
				$quey->execute();
				for($i=0; $row = $quey->fetch(); $i++){	 
						$nmed=$row['nmed'];
					echo $nmed;  } ?>					
						</td>
						<td class="textcenter w30 bgmain padd5 cpoint" onclick="mdlapp(modapp, 'appclose', '<?php echo $idt; ?>', '7h')"><?php echo $siet; ?></td>
						<td class="textcenter w30 bgmain padd5 cpoint"><?php echo $och; ?></td>
						<td class="textcenter w30 bgmain padd5 cpoint"><?php echo $trce; ?></td>
						<td class="textcenter w30 bgmain padd5 cpoint"><?php echo $dieco; ?></td>
						<td class="textcenter w30 bgmain padd5 cpoint"><?php echo $vtuno; ?></td>
						<td><?php 
				$quey3=$db2->prepare("SELECT nombre_unidad AS nuni FROM unidades WHERE id_unidad=:unidad");
				$quey3->bindParam(':unidad', $unidad);
				$quey3->execute();
				for($i=0; $row = $quey3->fetch(); $i++){	 
						$nuni=$row['nuni'];
					echo $nuni;  }

						echo $unidad; ?></td>
						
					</tr>
					<?php }	?>
			  </table>
			</div>
			</div>
<?php	}	?>

<?php 
include ("modal_app.php");
include ("ltrats_scripts.php"); ?>