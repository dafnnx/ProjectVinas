 	<div class="subcajapres">
 <div class="thelist">
 <table class="table" data-responsive="table" id="resultTable">
<?php	
require_once ("../cn/connect2.php");
require_once('../functions.php');
	$ires=$_POST['rid'];
	$result = $db2->prepare("SELECT * FROM payconcept WHERE user_id=:uid AND status=1");
	$result->bindParam(':uid', $uid);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){ 
			$idp= $row['id_pay'];
			$con= $row['concept_pay'];
			$can= $row['cantidad_pay'];
			$idcp= $row['idconcept_pay'];
		


			 ?>
<tr class="tdcar">
<td><?php echo $con  ?> --
<?php $ct= $db2->prepare("SELECT qtyind_medica AS qtyind FROM medicamentos WHERE id_id_medica=:idcp");
		$ct->bindParam(':idcp', $idcp);
		$ct->execute();
		for($i=0; $row = $ct->fetch(); $i++){ 		 $qtyind=$row['qtyind']; 		

  echo $qtyind;
}
?>

</td>
<td><?php echo $can  ?></td>
<td >
	<div class="delc" onclick="eliminar('<?php echo $idp; ?>', '<?php echo $uid; ?>', '1', '<?php echo $ires; ?>')" title='Descartar'></div>
</td>

</tr>
<?php  }?>
</table>
</div>
	</div>
	<?php 
	$rt = $db2->prepare("SELECT SUM(debe_pay) AS amount FROM payconcept WHERE user_id=:uid AND status=1");
	$rt->bindParam(':uid', $uid);
	$rt->execute();
	for($i=0; $row = $rt->fetch(); $i++){ $amount= $row['amount']; }  ?>
	<button class="nputsave" onclick="procesar('<?php echo $uid; ?>', '<?php echo $amount; ?>', '<?php echo $ires; ?>')">Procesar</button>