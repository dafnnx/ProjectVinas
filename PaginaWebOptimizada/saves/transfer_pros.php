<?php
require_once ("../cn/connect2.php");
$id=$_POST['id'];
 
 	$daat= $db2->prepare("SELECT * FROM prospectos WHERE id_prospecto=:id");
 	$daat->bindParam(':id', $id);
    $daat->execute();
    for($i=0; $row = $daat->fetch(); $i++){ 
    $aa= $row['curp_prospecto'];
	$ba= $row['nss_prospecto'];
	$ca= $row['nombre_prospecto'];
	$da= $row['tipologia_prospecto'];	
	$ea= $row['ecivil_prospecto'];
	$fa= $row['origen_prospecto'];
	$ga= $row['sexo_prospecto'];
	$ha= $row['edad_prospecto'];
	$ia= $row['fnac_prospecto'];
	$ja= $row['depen_prospecto'];
	$ka= $row['img_prospecto'];
	$la= $row['tarifa_prospecto']; }
	$ma= "1";

$sql2 = "INSERT INTO residentes (curp_residente, nss_residente, nombre_residente, tipologia_residente, ecivil_residente, origen_residente, sexo_residente, edad_residente, fnac_residente, depen_residente, img_residente, status_residente) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :m)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':k'=>$ka,':m'=>$ma));
	$rid = $db2->lastInsertId();

if($rid) {
				$sqlb = "UPDATE prospectos SET status_prospecto=2 WHERE id_prospecto=:id";
				$sss = $db2->prepare($sqlb);
				$sss->bindParam(':id', $id);
				$sss->execute();

				$sqlba = "UPDATE contactos SET id_residente=$rid WHERE id_prospecto=:id";
				$sssa = $db2->prepare($sqlba);
				$sssa->bindParam(':id', $id);
				$sssa->execute();

  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>