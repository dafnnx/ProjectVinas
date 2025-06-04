<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['days'];
	$ba= date('Y-m-d');

$coun= $db2->prepare("SELECT COUNT(*) AS numrows FROM dayscant WHERE fecha_days=:fc");
    $coun->bindParam(':fc', $ba);
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){   $numrows = $row['numrows'];	}
if ($numrows>0){
$sql2 = ("UPDATE dayscant SET num_days=$aa WHERE fecha_days='$ba'");
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {
	 echo "<span class='disponible'>Correcto.</span>";
  }  else   {   echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }
} else {
$sql2 = "INSERT INTO dayscant (fecha_days, num_days) VALUES (:a, :b)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$ba,':b'=>$aa));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
}	
?>