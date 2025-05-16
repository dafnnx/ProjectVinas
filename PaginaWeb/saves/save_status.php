<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['idr_status'];
	$ba= $_POST['status_status'];
	$ca= $_POST['motivo_status'];
	$da= $_POST['fecha_status'];
	$ea= $_POST['situa_status'];	
$sql2 = "UPDATE residentes SET status_residente='$ea', cama_residente=null WHERE id_residente=$aa";
$savs = $db2->prepare($sql2);
$savs->execute();

	if ($savs) {
		$sql2 = "UPDATE beds SET status_bed='1', id_residente=null, nombre_residente=null WHERE id_residente=$aa";
		$svs = $db2->prepare($sql2);
		$svs->execute();
	
			if($svs) {
				$sql2 = "INSERT INTO hist_status (id_residente, status_status, motivo_status, fecha_status) VALUES (:a, :b, :c, :d)";
				$sav = $db2->prepare($sql2);
				$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da));

						if($sav)
 								{ echo $aa; } 		else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";  }

						}		else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";  }

		}		else 	{      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";  }
?>