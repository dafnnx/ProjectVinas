<?php
require_once ("../cn/connect2.php");
      $idr= $_POST['idr'];
	$idp= $_POST['idp'];
$sql2 = "INSERT INTO patologias_residente (id_residente, id_patologia) VALUES (:idr, :idp)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':idr'=>$idr, ':idp'=>$idp));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>