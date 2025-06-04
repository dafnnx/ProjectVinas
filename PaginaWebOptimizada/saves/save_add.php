<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['tbl'];
	$ba= $_POST['cant'];
	$ca= $_POST['edif'];
	$da= $_POST['vari'];
	$today= date('Y-m-d');

	$coun= $db2->prepare("SELECT COUNT(*) AS numrows FROM $aa WHERE nom_edif='$ca' AND fecha_add='$today'");
    $coun->execute();
    for($i=0; $row = $coun->fetch(); $i++){   $numrows = $row['numrows'];	}
if ($numrows>0){
$sql2 = ("UPDATE $aa SET $da='$ba' WHERE nom_edif='$ca' AND fecha_add='$today'");
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {
	 echo "<span class='disponible'>Correcto.</span>";
  }  else   {   echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }
} else{
$sql2 = "INSERT INTO $aa (fecha_add, nom_edif, $da) VALUES (:a, :b, :c)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$today,':b'=>$ca,':c'=>$ba));
if($sav)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
}
		?>