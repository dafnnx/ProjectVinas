<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['id'];
	$ba= $_POST['chng'];
	$ca= $_POST['newval'];
	$da= $_POST['table'];
	$ea= $_POST['tgt'];	
$sql2 = "UPDATE $da SET $ba='$ca' WHERE $ea=$aa";
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {		echo "<span class='disponible'> Correcto.</span>";	
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>