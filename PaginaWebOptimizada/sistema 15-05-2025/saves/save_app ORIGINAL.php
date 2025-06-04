<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['idr_aplic'];
	$ba= $_POST['idt_aplic'];
	$ca= $_POST['hr_aplic'];
	$da= $_POST['med_aplic'];
	$ea= $_POST['qty_aplic'];
	$fa= $_POST['opt_aplic'];
	$ga= $_POST['inc_aplic'];
	$ha= $_POST['mot_aplic'];
	$ia= $_POST['obs_aplic'];
	$xa= $_POST['fech_aplic'];
	$ya="si";
	$za="no";
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
				$ry2=$db2->prepare("SELECT id_id_inventario AS id_id_i FROM hist_inventarios WHERE id_inventario=:idi");
				$ry2->bindParam(':idi', $idi);			
				$ry2->execute();
				for($i=0; $row = $ry2->fetch(); $i++){		$id_id_i=$row['id_id_i'];		 }	
		if (!$id_id_i) {
$sql3 = "INSERT INTO hist_inventarios (id_inventario, id_residente, id_tratamiento, medicamento_hinv, $ca, ".$ca."opt_hinv, ".$ca."inc_hinv, ".$ca."mot_hinv, ".$ca."obs_hinv, fech_hinv) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j)";
$savx = $db2->prepare($sql3);
$savx->execute(array(':a'=>$idi,':b'=>$aa,':c'=>$ba,':d'=>$da,':e'=>$ya,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$xa));		} 
		else 	{
$sql2 = "UPDATE hist_inventarios SET $ca='$ya', ".$ca."opt_hinv='$fa', ".$ca."inc_hinv='$ga', ".$ca."mot_hinv='$ha', ".$ca."obs_hinv='$ia' WHERE id_id_inventario=$id_id_i";
$savx = $db2->prepare($sql2);
$savx->execute();		}
}
		break;
	case '2':		
				$ry2=$db2->prepare("SELECT id_id_inventario AS id_id_i FROM hist_inventarios WHERE id_inventario=:idi");
				$ry2->bindParam(':idi', $idi);			
				$ry2->execute();
				for($i=0; $row = $ry2->fetch(); $i++){		$id_id_i=$row['id_id_i'];		 }	
		if (!$id_id_i) {
$sql3 = "INSERT INTO hist_inventarios (id_inventario, id_residente, id_tratamiento, medicamento_hinv, $ca, ".$ca."opt_hinv, ".$ca."inc_hinv, ".$ca."mot_hinv, ".$ca."obs_hinv, fech_hinv) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j)";
$savx = $db2->prepare($sql3);
$savx->execute(array(':a'=>$idi,':b'=>$aa,':c'=>$ba,':d'=>$da,':e'=>$za,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$xa));		} 
		else 	{
$sql2 = "UPDATE hist_inventarios SET $ca='$za', ".$ca."opt_hinv='$fa', ".$ca."inc_hinv='$ga', ".$ca."mot_hinv='$ha', ".$ca."obs_hinv='$ia' WHERE id_id_inventario=$id_id_i";
$savx = $db2->prepare($sql2);
$savx->execute();		}
		break;
	default:
}		?>