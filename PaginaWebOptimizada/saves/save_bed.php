<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['n_bed'];
	$ba= $_POST['rid'];
	$ca= "1";	
$sql2 = "INSERT INTO beds (nombre_bed, id_room, status_bed) VALUES (:a, :b, :c)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>