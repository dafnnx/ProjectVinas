<?php
	include('../cn/connect2.php');
	$id=$_POST['id'];
		$count_query= $db2->prepare("SELECT * FROM payconcept WHERE id_pay=:id");
		$count_query->bindParam(':id', $id);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){ 
		 $idp=$row['idconcept_pay']; 
		 $qty=$row['cantidad_pay']; 
		}
		$coun= $db2->prepare("SELECT * FROM medicamentos WHERE id_id_medica=:idp");
		$coun->bindParam(':idp', $idp);
		$coun->execute();
		for($i=0; $row = $coun->fetch(); $i++){ 
		 $qtya=$row['stock_medica']; 
		}

$sql2 = "UPDATE medicamentos SET stock_medica=$qty+$qtya WHERE id_id_medica=:idp";
$sav = $db2->prepare($sql2);
$sav->bindParam(':idp', $idp);
$sav->execute();

if ($sav) {
	$query = $db2->prepare("DELETE FROM payconcept WHERE id_pay=:id");
	$query->bindParam(':id', $id);
	$query->execute();
}

else{
	echo 'Error: ' . $e->getMessage();
    exit();
}
?>