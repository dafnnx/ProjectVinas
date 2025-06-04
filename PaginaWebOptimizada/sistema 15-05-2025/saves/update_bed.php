<?php
require_once ("../cn/connect2.php");
	$ssta= $_POST['ssta'];
	$bid= $_POST['bid'];		

						$count_query= $db2->prepare("SELECT id_residente AS idr FROM beds WHERE id_bed=:bid");
    				$count_query->bindParam(':bid', $bid);
    				$count_query->execute();
    				for($i=0; $row = $count_query->fetch(); $i++){    $idr = $row['idr'];		}

    if ($idr) {

		$sql2 = "UPDATE residentes SET cama_residente=null WHERE id_residente=$idr";
		$svb = $db2->prepare($sql2);
		$svb->execute();

						if ($svb) {
						$sql2 = "UPDATE beds SET status_bed='$ssta', id_residente=null, nombre_residente=null WHERE id_bed=$bid";
						$svs = $db2->prepare($sql2);
						$svs->execute();
								}			else 		{      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	

		}			else {   


						$sql2 = "UPDATE beds SET status_bed='$ssta', id_residente=null, nombre_residente=null WHERE id_bed=$bid";
						$svs = $db2->prepare($sql2);
						$svs->execute();


		     }	

	?>