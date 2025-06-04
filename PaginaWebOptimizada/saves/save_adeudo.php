<?php
	require_once ("../cn/connect2.php");
$rid= $_POST['rid'];
$deb= $_POST['deb'];
$dat= date('Y-m-d');
$sta= "2";
	$sql2 = "INSERT INTO payconcept (fecha_pay, debe_pay, id_residente, reg_pay, status) VALUES (:a, :b, :c, :d, :e)";
	$sav = $db2->prepare($sql2);
	$sav->execute(array(':a'=>$dat,':b'=>$deb,':c'=>$rid,':d'=>$dat,':e'=>$sta));
	if($sav) {
	echo "<span class='disponible'> Correcto. </span>";	
 	 } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>