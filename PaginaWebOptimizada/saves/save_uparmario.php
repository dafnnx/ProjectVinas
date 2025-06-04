<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['nrid'];
	$ca= $_POST['fec'];
$sql2 = "INSERT INTO armario (id_residente, armario_fecha) VALUES (:a, :c)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa, ':c'=>$ca));
if($sav)
 { echo "$aa"; } 
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>