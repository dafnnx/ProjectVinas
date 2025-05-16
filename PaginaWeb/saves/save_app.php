<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['idr_aplic'];
	$ba= $_POST['idt_aplic'];
	$ca= $_POST['hr_aplic'];
	$da= $_POST['med_aplic'];
	$ea= $_POST['qty_aplic'];
	$fa= $_POST['opt_aplic-'.$ca.''];
	$ga= $_POST['obs_aplic'];
	$ha= $_POST['fech_aplic'];
	$fech= date('Y-m-d H:i');

				$ry=$db2->prepare("SELECT id_inventario AS idi FROM inventarios WHERE id_residente=:idr AND medicamento_inv=:med");
				$ry->bindParam(':idr', $aa);	
				$ry->bindParam(':med', $da);			
				$ry->execute();
				for($i=0; $row = $ry->fetch(); $i++){		$idi=$row['idi'];		 }					
switch ($fa) {

	case '1':
$sql2 = "UPDATE inventarios SET cantidad_inv=cantidad_inv-'$ea' WHERE id_inventario=$idi ";
$sav = $db2->prepare($sql2);
$sav->execute();
		if($sav) {
				$ry2=$db2->prepare("SELECT id_id_inventario AS id_id_i FROM hist_inventarios WHERE id_inventario=:idi AND fech_hinv=:fech");
				$ry2->bindParam(':idi', $idi);
				$ry2->bindParam(':fech', $ha);			
				$ry2->execute();
				for($i=0; $row = $ry2->fetch(); $i++){		$id_id_i=$row['id_id_i'];		 }	
		if (!$id_id_i) {
$sql3 = "INSERT INTO hist_inventarios (id_inventario, id_residente, id_tratamiento, medicamento_hinv, $ca, ".$ca."opt_hinv, ".$ca."obs_hinv, fech_hinv) VALUES (:a, :b, :c, :d, :e, :f, :g, :h)";
$savx = $db2->prepare($sql3);
$savx->execute(array(':a'=>$idi,':b'=>$aa,':c'=>$ba,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha));		} 
		else 	{
$sql2 = "UPDATE hist_inventarios SET $ca='$ea', ".$ca."opt_hinv='$fa', ".$ca."obs_hinv='$ga' WHERE id_id_inventario=$id_id_i";
$savx = $db2->prepare($sql2);
$savx->execute();		}
}
		break;
	case '2':		
				$ry2=$db2->prepare("SELECT id_id_inventario AS id_id_i FROM hist_inventarios WHERE id_inventario=:idi AND fech_hinv=:fech");
				$ry2->bindParam(':idi', $idi);			
				$ry2->bindParam(':fech', $ha);	
				$ry2->execute();
				for($i=0; $row = $ry2->fetch(); $i++){		$id_id_i=$row['id_id_i'];		 }	
		if (!$id_id_i) {
$sql3 = "INSERT INTO hist_inventarios (id_inventario, id_residente, id_tratamiento, medicamento_hinv, $ca, ".$ca."opt_hinv, ".$ca."obs_hinv, fech_hinv) VALUES (:a, :b, :c, :d, :e, :f, :g, :h)";
$savx = $db2->prepare($sql3);
$savx->execute(array(':a'=>$idi,':b'=>$aa,':c'=>$ba,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha));		} 
		else 	{
$sql2 = "UPDATE hist_inventarios SET $ca='$ea', ".$ca."opt_hinv='$fa', ".$ca."obs_hinv='$ga' WHERE id_id_inventario=$id_id_i";
$savx = $db2->prepare($sql2);
$savx->execute();		}
		break;
	default:
}	

if ($savx) {
	$opt="3";
$nresq= $db2->prepare("SELECT nombre_residente AS nres FROM residentes WHERE id_residente=:aa");
$nresq->bindParam(':aa', $aa);
$nresq->execute();
for($i=0; $row = $nresq->fetch(); $i++){ 		
	$nres = $row['nres'];	   } 

$cquer= $db2->prepare("SELECT cantidad_inv AS ncinv,  nombre_medica AS nommed  FROM inventarios WHERE id_inventario=:idi");
$cquer->bindParam(':idi', $idi);
$cquer->execute();
for($i=0; $row = $cquer->fetch(); $i++){ 		
	$ncinv = $row['ncinv'];
	$nommed = $row['nommed'];	   }  
$sql = "INSERT INTO historial_inventarios (opt_historial, id_medicamento, nombre_medica, id_inventario, fecha_historial, id_residente, nombre_residente, cantidad_medica, total_medica) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i)";
$savr = $db2->prepare($sql);
$savr->execute(array(':a'=>$opt, ':b'=>$da, ':c'=>$nommed, ':d'=>$idi, ':e'=>$fech, ':f'=>$aa, ':g'=>$nres, ':h'=>$ea, ':i'=>$ncinv));
if($savr)
 { echo "<span class='disponible'> Correcto.</span>"; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
}	?>