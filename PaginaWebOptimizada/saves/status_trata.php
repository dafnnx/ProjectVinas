<?php 
require_once ("../cn/connect2.php");
    $valu = $_POST['valu'];
    $idt = $_POST['idt'];

	$sql2 = "UPDATE tratamientos SET status_tratamiento='$valu' WHERE id_tratamiento=$idt";
	$sav = $db2->prepare($sql2);
	$sav->execute();
?>