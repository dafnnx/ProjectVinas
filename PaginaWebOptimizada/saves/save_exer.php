<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['min'];
      $ba= $_POST['max'];
      $ca= $_POST['res'];
      $da= $_POST['rid'];
      $ea= date('Y-m-d');
$sql2 = "INSERT INTO ejercicios (min_ejercicio, max_ejercicio, resultado_ejercicio,  id_residente, fecha_ejercicio) VALUES (:a, :b, :c, :d, :e)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa, ':b'=>$ba, ':c'=>$ca, ':d'=>$da, ':e'=>$ea));
if($sav)
 { 
      $eid = $db2->lastInsertId();


            $sql = "UPDATE payconcept SET id_ejercicio=$eid WHERE id_residente=$da AND status=2 AND id_ejercicio IS NULL";
            $svb = $db2->prepare($sql);
            $svb->execute();

  }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>


