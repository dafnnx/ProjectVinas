<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['nrid'];
	$ba= $_POST['idt'];

$sql2 = "UPDATE tratamientos SET id_tratamiento='$ba', status_tratamiento='1' WHERE id_residente='$aa' AND status_tratamiento=2 ";
$sav = $db2->prepare($sql2);
$sav->execute();


if($sav)
 { echo "<span class='disponible'>Correcto</span>"; } 
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?> 