<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['idr_ropastatus'];
	$ba= $_POST['status_ropastatus'];
	$ca= $_POST['motivo_ropastatus'];
	$da= $_POST['fecha_ropastatus'];	
	$ea= $_POST['persona_ropastatus'];	
$sql2 = "INSERT INTO hist_ropastatus (id_rresidente, status_ropastatus, motivo_ropastatus, fecha_ropastatus, persona_ropastatus) VALUES (:a, :b, :c, :d, :e)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea));
if($sav)
 { echo $aa; } 
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>