<?php
require_once ("../cn/connect2.php");
	$idr= $_POST['idr'];
	$mot= $_POST['mot'];
	$per= $_POST['per'];	
	$sta= "baja";		
	$fec= date('d-m-Y');

		$sql2 = "UPDATE ropa_residente SET status_ropa='$sta' WHERE id_rresidente=$idr";
		$svb = $db2->prepare($sql2);
		$svb->execute();
			if ($svb) {				
$sql3 = "INSERT INTO hist_ropastatus (id_rresidente, status_ropastatus, motivo_ropastatus, fecha_ropastatus, persona_ropastatus) VALUES (:a, :b, :c, :d, :e)";
$sav = $db2->prepare($sql3);
$sav->execute(array(':a'=>$idr,':b'=>$sta,':c'=>$mot,':d'=>$fec,':e'=>$per));		}	
	else 		{      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	

	?>