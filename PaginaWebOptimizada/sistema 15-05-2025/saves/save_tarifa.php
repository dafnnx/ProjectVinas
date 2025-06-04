<?php
	require_once ("../cn/connect2.php");
$fin= $_POST['fin'];
$rid= $_POST['rid'];
$tar= $_POST['tar'];
$mes= $_POST['mes'];
$abo= $_POST['abo'];
$fpa= $_POST['fpa'];
$fca= date('Y-m-d');
$per= $_POST['fpe'];
	$sql2 = "INSERT INTO tarifas (dia_tarifa, id_residente, tarifa_residente, fecha_tarifa, abono_tarifa, fpago_tarifa, fcap_tarifa, persona_tarifa) VALUES (:a, :b, :c, :d, :e, :f, :g, :h)";
	$sav = $db2->prepare($sql2);
	$sav->execute(array(':a'=>$fin,':b'=>$rid,':c'=>$tar,':d'=>$mes,':e'=>$abo,':f'=>$fpa,':g'=>$fca,':h'=>$per));
	if($sav) {
	echo "<span class='disponible'> Correcto. </span>";	
 	 } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>