<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['resic_inv'];	
	$ba= $_POST['med_inv'];
	$ca= $_POST['talla_inv'];	
	$da= $_POST['unidad_inv'];
	$ea= $_POST['marca_inv'];
	$fa= $_POST['vencimiento_inv'];
	$ga= $_POST['observa_inv'];
	$ha= $_POST['cantidad_inv'];	
	$ia= $_POST['user_id'];
	$ja= date('Y-m-d');
	$xa= $_POST['nombre_medica'];
	$fech= date('Y-m-d H:i');
$sql2 = "INSERT INTO inventarios (id_residente, medicamento_inv, talla_inv, unidad_inv, marca_inv, vencimiento_inv, observa_inv, cantidad_inv, user_id, fecha_inv, nombre_medica) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :x)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':x'=>$xa));
$id = $db2->lastInsertId();
if($sav) { 
$uery= $db2->prepare("SELECT nombre_residente AS nres FROM residentes WHERE id_residente=:aa");
$uery->bindParam(':aa', $aa);
$uery->execute();
for($i=0; $row = $uery->fetch(); $i++){ 		$nres = $row['nres'];	   }  
$sql = "INSERT INTO historial_inventarios (opt_historial, id_medicamento, nombre_medica, id_inventario, fecha_historial, id_residente, nombre_residente, cantidad_medica, total_medica) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i)";
$savr = $db2->prepare($sql);
$savr->execute(array(':a'=>"1", ':b'=>$ba, ':c'=>$xa, ':d'=>$id, ':e'=>$fech, ':f'=>$aa, ':g'=>$nres, ':h'=>$ha, ':i'=>$ha));
if($savr)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }  } 
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>