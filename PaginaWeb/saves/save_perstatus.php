<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['idp_status'];
	$ba= $_POST['status_perstatus'];
	$ca= $_POST['motivo_perstatus'];
	$da= $_POST['fecha_perstatus'];
$sql2 = "UPDATE personal SET status_personal='$ba' WHERE id_personal=$aa";
$savs = $db2->prepare($sql2);
$savs->execute();	

if($savs) {
	if ($ba=="2") {
	$sqld = "DELETE FROM users WHERE id_personal=$aa";
	$savx = $db2->prepare($sqld);
	$savx->execute();	}

				$sql3 = "INSERT INTO hist_perstatus (id_personal, status_perstatus, motivo_perstatus, fecha_perstatus) VALUES (:a, :b, :c, :d)";
				$sav = $db2->prepare($sql3);
				$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da));
						if($sav)
 								{ echo $aa; } 		else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";  }

		} else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";  }
?>