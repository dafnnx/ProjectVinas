<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['id'];
	$ba= $_POST['val'];
	
	switch ($ba) {
		case 1:
			$ba="0";
		break;
		case 0:
			$ba="1";
		break;
		case null:
			$ba="1";
		break;
	}



				$sql2 = "UPDATE contactos SET fav_contacto='$ba' WHERE id_contacto=$aa";
				$sav = $db2->prepare($sql2);
				$sav->execute();
				if($sav) {		echo "<span class='disponible'> Correcto.</span>";	
  			} else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }
							 
	?>