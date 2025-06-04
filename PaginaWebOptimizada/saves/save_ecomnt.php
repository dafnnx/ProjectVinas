<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['rid'];
	$ba= $_POST['fec'];	
	$ca= $_POST['mes'];
	$da= $_POST['abo'];
	$ea= $_POST['fpa'];
	$fa= date('Y-m-d');
	$ga= $_POST['fpe'];
$sql2 = "INSERT INTO paymont (fecha_paym, mes_paym, cantidad_paym, fpago_paym, id_residente, feccap_paym, persona_paym) VALUES (:a, :b, :c, :d, :e, :f, :g)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$ba,':b'=>$ca,':c'=>$da,':d'=>$ea,':e'=>$aa,':f'=>$fa,':g'=>$ga));
if($sav) {
	echo "<span class='disponible'> Correcto. </span>";	
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	
	?>