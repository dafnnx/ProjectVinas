<?php
$idr=$_POST['idr'];
$fec=$_POST['fec'];
$hou=$_POST['hou'];
switch ($hou) {
	case '7h':		$hou="siet_tratamiento";	break;
	case '8h':		$hou="och_tratamiento";		break;
	case '13h':		$hou="trce_tratamiento";	break;
	case '18h':		$hou="dieco_tratamiento";	break;
	case '21h':		$hou="vtuno_tratamiento";	break;
	default:
}
	require_once ("../cn/connect2.php"); 	
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM tratamientos WHERE id_residente=:idr");
		$count_query->bindParam(':idr', $idr);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){		$numrows = $row['numrows'];			}
		if ($numrows>0){				?>
			<div class="noedge">
			<div class="">

			  <table class="table" data-responsive="table" id="resultTable">
				<?php
				$query=$db2->prepare("SELECT DISTINCT id_tratamiento AS idt FROM tratamientos WHERE fecha_ini<=:fec /* AND fecha_fin>=:fec*/ AND id_residente=:idr AND $hou>='.1'");
				$query->bindParam(':idr', $idr);
				$query->bindParam(':fec', $fec);
				$query->execute();
				for($i=0; $row = $query->fetch(); $i++){
					$idt=$row['idt'];

				$ry=$db2->prepare("SELECT * FROM tratamientos WHERE id_tratamiento=:idt");
				$ry->bindParam(':idt', $idt);			
				$ry->execute();
				for($i=0; $row = $ry->fetch(); $i++){
						$med=$row['med_tratamiento'];
						/*
						$siet=$row['siet_tratamiento'];
						$och=$row['och_tratamiento'];
						$trce=$row['trce_tratamiento'];
						$dieco=$row['dieco_tratamiento'];
						$vtuno=$row['vtuno_tratamiento']; */
						$unidad=$row['unidad_medicamento'];				 ?>
				<tr class="cpoint bgmain bgghost" onclick="trat_specs('<?php echo $idr; ?>', '<?php echo $idt; ?>', '<?php echo $fec; ?>');">
						<td class="w300"></td>
						<td class="w300"><?php
				$quey=$db2->prepare("SELECT nombre_medica AS nmed FROM medicamentos WHERE id_medica=:med");
				$quey->bindParam(':med', $med);
				$quey->execute();
				for($i=0; $row = $quey->fetch(); $i++){	 
						$nmed=$row['nmed'];
					echo $nmed;  } ?>					
						</td>
						<td><?php 
				$quey3=$db2->prepare("SELECT nombre_unidad AS nuni FROM unidades WHERE id_unidad=:unidad");
				$quey3->bindParam(':unidad', $unidad);
				$quey3->execute();
				for($i=0; $row = $quey3->fetch(); $i++){	 
						$nuni=$row['nuni'];
					echo $nuni;  } ?>							
						</td>						
				</tr>
<?php	}	 }	?>
			  </table>
			</div>
			</div>

<?php	}	include ("supervision.js"); ?>
