<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['code_residente'];
	$ba= $_POST['curp_residente'];
	$ca= $_POST['nss_residente'];
	$da= $_POST['nombre_residente'];
	$ea= $_POST['tipologia_residente'];	
	$fa= $_POST['ecivil_residente'];
	$ga= $_POST['habitacion_residente'];
	$ha= $_POST['origen_residente'];
	$ia= $_POST['sexo_residente'];
	$ja= $_POST['edad_residente'];
	$ka= $_POST['cama_residente'];
	$la= $_POST['fnac_residente'];
	$ma= $_POST['ingreso_residente'];
	$na= $_POST['ultingreso_residente'];
	$oa= $_POST['apodo_residente'];
	$pa= $_POST['depen_residente'];
	$xa= $_POST['bedid'];
	$ya= $_POST['ctesae_residente'];
	$za= $_POST['tarifa_residente'];
	$ale= $_POST['alergia_residente'];
	$pat= $_POST['patologia_residente'];
	$rcp= $_POST['rcp_residente'];
$sql2 = "UPDATE residentes SET curp_residente='$ba', nss_residente='$ca', nombre_residente='$da', tipologia_residente='$ea', ecivil_residente='$fa', habitacion_residente='$ga', origen_residente='$ha', sexo_residente='$ia', edad_residente='$ja', cama_residente='$ka', fnac_residente='$la', ingreso_residente='$ma', ultingreso_residente='$na', apodo_residente='$oa', depen_residente='$pa', cte_sae='$ya', tarifa_residente='$za', alergia_residente='$ale', patologia_residente='$pat', rcp_residente='$rcp' WHERE id_residente=$aa";
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {
			$query=$db2->prepare("SELECT id_bed AS idb FROM beds WHERE id_residente=:id");
			$query->bindParam(':id', $aa);
			$query->execute();	
				for($i=0; $row = $query->fetch(); $i++)
					{ 	$idb= $row['idb'];		 }
						if ($idb) {
							if ($idb==$xa) {	}
								else{	
									$sqlb = "UPDATE beds SET status_bed=2 , id_residente='$aa', nombre_residente='$da' WHERE id_bed=$xa";
									$sss = $db2->prepare($sqlb);
									$sss->execute();
										if ($sss) {
												$sqlb = "UPDATE beds SET status_bed=1 , id_residente=null, nombre_residente=null WHERE id_bed=$idb";
												$sss2 = $db2->prepare($sqlb);
												$sss2->execute();
										}
								}
						} 
						else{		$sqlb = "UPDATE beds SET status_bed=2 , id_residente='$aa', nombre_residente='$da' WHERE id_bed=$xa";
									$sss = $db2->prepare($sqlb);
									$sss->execute();
						}
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>