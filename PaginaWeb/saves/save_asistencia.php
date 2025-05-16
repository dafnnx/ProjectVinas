<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['pid'];
      $ba= $_POST['theres'];
      $ca= date('Y-m-d H:i:s');
$sql2 = "INSERT INTO asistencias (id_personal, id_residente, fecha_asistencia) VALUES (:a, :b, :c)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa, ':b'=>$ba, ':c'=>$ca));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>