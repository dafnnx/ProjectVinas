<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['tosave'];
      $ba= $_POST['idm'];
$sql2 = "INSERT INTO rel_act_med (id_activo, id_medica) VALUES (:a, :b)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa, ':b'=>$ba));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>