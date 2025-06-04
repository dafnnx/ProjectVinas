<?php
require_once ("../cn/connect2.php");
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
	$qa= $_POST['user_id'];
	$xa= $_POST['bedid'];
	$sta= "1";
	$mot= "ingreso";
	$sae= $_POST['ctesae_residente'];
	$tar= $_POST['tarifa_residente'];
	$ale= $_POST['alergia_residente'];
	$pat= $_POST['patologia_residente'];
	$rcp= $_POST['rcp_residente'];
$sql2 = "INSERT INTO residentes (curp_residente, nss_residente, nombre_residente, tipologia_residente, ecivil_residente, habitacion_residente, origen_residente, sexo_residente, edad_residente, cama_residente, fnac_residente, ingreso_residente, ultingreso_residente, apodo_residente, depen_residente, user_id, cte_sae, status_residente, tarifa_residente, alergia_residente, patologia_residente, rcp_residente) VALUES (:b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n, :o, :p, :q, :r, :y, :z, :za, :zb, :zc)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':k'=>$ka,':l'=>$la,':m'=>$ma,':n'=>$na,':o'=>$oa,':p'=>$pa,':q'=>$qa,':r'=>$sae,':y'=>$sta,':z'=>$tar,':za'=>$ale,':zb'=>$pat,':zc'=>$rcp));
if($sav) {
	$rid = $db2->lastInsertId();
	echo $rid;
		if ($rid) {
				$sqlb = "UPDATE beds SET status_bed=2 , id_residente='$rid', nombre_residente='$da' WHERE id_bed=$xa";
				$sss = $db2->prepare($sqlb);
				$sss->execute();
			}	else	{      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>