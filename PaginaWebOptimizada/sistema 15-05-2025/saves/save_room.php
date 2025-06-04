<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['n_room'];
	$ba= $_POST['pid'];	
$sql2 = "INSERT INTO rooms (nombre_room, id_piso) VALUES (:a, :b)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>