<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['id_residente'];
	$ba= $_POST['alta_contrato'];
	$ca= $_POST['inicio_contrato'];
	$da= $_POST['fin_contrato'];
	$ea= "1";	
$sql2 = "INSERT INTO contratos (id_residente, alta_contrato, inicio_contrato, fin_contrato, status_contrato) VALUES (:a, :b, :c, :d, :e)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea));
if($sav) {
	echo "<span class='disponible'> Correcto.</span>";	
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>