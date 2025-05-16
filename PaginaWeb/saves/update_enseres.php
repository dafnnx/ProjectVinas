<?php
require_once ("../cn/connect2.php");
	$rid= $_POST['rid'];
	$mot= $_POST['mot'];
	$per= $_POST['per'];	
	$sta= "baja";		
	$fec= date('d-m-Y');
					$cery= $db2->prepare("SELECT DISTINCT id_rresidente AS numrows FROM ropa_residente WHERE id_residente=:rid");
    				$cery->bindParam(':rid', $rid);
    				$cery->execute();
    				for($i=0; $row = $cery->fetch(); $i++){    $numrows = $row['numrows'];		}

    if ($numrows) {

		$sql2 = "UPDATE ropa_residente SET status_ropa='$sta' WHERE id_residente=$rid";
		$svb = $db2->prepare($sql2);
		$svb->execute();
			if ($svb) {

			$count_query= $db2->prepare("SELECT DISTINCT id_rresidente AS idrr FROM ropa_residente WHERE id_residente=:rid");
    		$count_query->bindParam(':rid', $rid);
    		$count_query->execute();
    		for($i=0; $row = $count_query->fetch(); $i++){    $idrr = $row['idrr'];		

				
$sql3 = "INSERT INTO hist_ropastatus (id_rresidente, status_ropastatus, motivo_ropastatus, fecha_ropastatus, persona_ropastatus) VALUES (:a, :b, :c, :d, :e)";
$sav = $db2->prepare($sql3);
$sav->execute(array(':a'=>$idrr,':b'=>$sta,':c'=>$mot,':d'=>$fec,':e'=>$per));




			}		}			else 		{      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	
		}		else	 {   	echo "<span class='disponible'>El residente no tiene enseres capturados</span>";     }	

	?>