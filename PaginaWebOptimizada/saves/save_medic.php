<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['tosave'];
      $ba= $_POST['tosave2'];
$sql2 = "INSERT INTO medics (nom_medic, ced_medic) VALUES (:a, :b)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa, ':b'=>$ba));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>