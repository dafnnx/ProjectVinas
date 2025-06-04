<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['n_edif'];
	$ba= date('d-m-Y');
	$ca= $_POST['uid'];
$sql2 = "INSERT INTO edificios (nombre_edificio, fecha_edificio, user_id) VALUES (:a, :b, :c)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca));
if($sav)
 { return true; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>