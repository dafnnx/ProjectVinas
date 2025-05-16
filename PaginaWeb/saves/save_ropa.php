<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['tosave'];
$sql2 = "INSERT INTO ropa (nombre_ropa) VALUES (:a)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>