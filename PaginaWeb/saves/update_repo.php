<?php
require_once ("../cn/connect2.php");
$aa= $_POST['idr'];
$ba= $_POST['rept'];
$ca= $_POST['tresu'];

	$sql3 = "SELECT MAX(id_repo) AS idrp FROM repos WHERE id_residente=$aa";
	$sa3 = $db2->prepare($sql3);
	$sa3->execute();
	for($i=0; $row = $sa3->fetch(); $i++)
		{		$idrp = $row['idrp'];		}

$sql2 = "UPDATE repos SET reposi_repo='$ba', res_repo='$ca'	WHERE id_repo='$idrp' AND id_residente=$aa";
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {		echo "<span class='disponible'> Correcto.</span>";	
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>