<?php
require_once ("../cn/connect2.php");
      $idr= $_POST['idr'];
	$ida= $_POST['ida'];
$sql2 = "INSERT INTO alergias_residente (id_residente, id_alergia) VALUES (:idr, :ida)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':idr'=>$idr, ':ida'=>$ida));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>