<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['tbl'];
	$ba= $_POST['tgt'];
	$ca= $_POST['opt'];
	$da= $_POST['idi'];
	$ea= $_POST['opera_var'];
	$fa= date('Y-m-d H:i');
	$ga= $_POST['rid'];


$uery= $db2->prepare("SELECT nombre_residente AS nres FROM residentes WHERE id_residente=:ga");
$uery->bindParam(':ga', $ga);
$uery->execute();
for($i=0; $row = $uery->fetch(); $i++){ 		$nres = $row['nres'];	   }  

$cquery= $db2->prepare("SELECT * FROM inventarios WHERE id_inventario=:da");
$cquery->bindParam(':da', $da);
$cquery->execute();
for($i=0; $row = $cquery->fetch(); $i++){ 	

	$cinv = $row['cantidad_inv'];
	$med = $row['medicamento_inv'];
	$nom = $row['nombre_medica'];

	   }  
switch ($ca) {
	case '1':
				$sql2 = "UPDATE $aa SET $ba='$cinv'+'$ea' WHERE id_inventario=$da";
				$sav = $db2->prepare($sql2);
				$sav->execute();
			if($sav) {		echo "<span class='disponible'> Correcto.</span>";	
  						} else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }
		break;
	case '2':
				$sql2 = "UPDATE $aa SET $ba='$cinv'-'$ea' WHERE id_inventario=$da";
				$sav = $db2->prepare($sql2);
				$sav->execute();
			if($sav) {		echo "<span class='disponible'> Correcto.</span>";	
  						} else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }			   
		break;		
}
if ($sav) {
$cquer= $db2->prepare("SELECT cantidad_inv AS ncinv FROM inventarios WHERE id_inventario=:da");
$cquer->bindParam(':da', $da);
$cquer->execute();
for($i=0; $row = $cquer->fetch(); $i++){ 		$ncinv = $row['ncinv'];	   }  
$sql = "INSERT INTO historial_inventarios (opt_historial, id_medicamento, nombre_medica, id_inventario, fecha_historial, id_residente, nombre_residente, cantidad_medica, total_medica) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i)";
$savr = $db2->prepare($sql);
$savr->execute(array(':a'=>$ca, ':b'=>$med, ':c'=>$nom, ':d'=>$da, ':e'=>$fa, ':f'=>$ga, ':g'=>$nres, ':h'=>$ea, ':i'=>$ncinv));
if($savr)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
}

/*

$sql2 = "UPDATE $aa SET $ba='$ca' WHERE id_inventario=$da";
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {		echo "<span class='disponible'> Correcto.</span>";	
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	
*/

?>