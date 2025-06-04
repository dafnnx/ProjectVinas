<?php 
require_once ("../cn/connect2.php");
	$idcp = $_POST['idcp'];
    $tot = $_POST['tot'];
    $iva = $_POST['iva'];

	$sql2 = "UPDATE payconcept SET debe_pay='$tot', iva_pay='$iva' WHERE id_pay=$idcp";
	$sav = $db2->prepare($sql2);
	$sav->execute();
?>