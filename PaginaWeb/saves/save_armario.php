<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['rid'];
	$ba= $_POST['uid'];
	$ca= date('d-m-Y');
$sql2 = "INSERT INTO armario (id_residente, user_id, armario_fecha) VALUES (:a, :b, :c)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca));
$aid = $db2->lastInsertId();
if($sav)	
 { echo "$aid"; } 
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>