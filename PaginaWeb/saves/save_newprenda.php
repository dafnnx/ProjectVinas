<?php
require_once ("../cn/connect2.php");
	$idr= $_POST['resi_id'];
	$aa= $_POST['nombre_ropa'];
	$ba= $_POST['talla_ropa'];
	$ca= $_POST['marca_ropa'];
	$da= $_POST['color_ropa'];
	$ea= $_POST['observa_ropa'];
	$fa= date('d-m-Y');
	$ga= $_POST['estado_ropa'];

   $stmt = $db2->prepare("SELECT nombre_residente AS nres, apodo_residente AS apres FROM residentes WHERE id_residente=:idr");
   $stmt->bindParam(':idr', $idr);
   $stmt->execute();
   for($i=0; $row = $stmt->fetch(); $i++){
		$nres = $row['nres'];
		$apres = $row['apres'];
	}
$star="activo";
$motr="alta";
$perr="alta";

$sql2 = "INSERT INTO ropa_residente (nombre_ropa, talla_ropa, marca_ropa, color_ropa, observa_ropa, ingreso_ropa, estado_ropa, id_residente, nombre_residente, apodo_residente, status_ropa) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$idr,':i'=>$nres,':j'=>$apres,':k'=>$star));

if($sav) {
$rrid = $db2->lastInsertId();
		if ($rrid){			
	$sql = "INSERT INTO hist_ropastatus (id_rresidente, status_ropastatus, motivo_ropastatus, fecha_ropastatus, persona_ropastatus) VALUES (:rrid, :star, :motr, :fecr, :perr)";
	$sav2 = $db2->prepare($sql);
	$sav2->execute(array(':rrid'=>$rrid, ':star'=>$star, ':motr'=>$motr, ':fecr'=>$fa, ':perr'=>$perr));
			}
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }
//DAFNNX GUARDA NUEVO ENSER
?>