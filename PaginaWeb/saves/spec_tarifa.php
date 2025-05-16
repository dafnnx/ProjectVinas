<?php
	require_once ("../cn/connect2.php");
$rid= $_POST['rid'];
$tar= $_POST['tar'];
$mes= $_POST['mes'];
	$sql2 = "INSERT INTO tarifas (id_residente, tarifa_residente, fecha_tarifa) VALUES (:a, :b, :c)";
	$sav = $db2->prepare($sql2);
	$sav->execute(array(':a'=>$rid,':b'=>$tar,':c'=>$mes));
	if($sav) {
	echo "<span class='disponible'> Correcto. </span>";	
 	 } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>