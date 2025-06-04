<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['pname'];
$sql2 = "INSERT INTO ropa (nombre_ropa) VALUES (:a)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa));
if($sav)
 { } 
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>