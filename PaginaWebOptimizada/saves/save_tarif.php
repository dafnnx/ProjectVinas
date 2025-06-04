<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['rid'];
	$ba= $_POST['tarif'];
$sql2 = "UPDATE residentes SET tarifa_residente='$ba' WHERE id_residente=$aa";
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav)
 { echo "$tarif"; } 
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>