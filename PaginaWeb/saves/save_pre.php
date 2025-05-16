<?php
require_once ("../cn/connect2.php");
	$uid=$_POST['uid'];
	$idm=$_POST['idm'];
	$rid=$_POST['rid'];
	$ba="1";
	$xa=date('Y-m-d');
	$xb=date('H:i');
	$ca=$xa."T".$xb;
		$count_query= $db2->prepare("SELECT * FROM medicamentos WHERE id_id_medica=:idm");
		$count_query->bindParam(':idm', $idm);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){ 
		 $id_id_medica=$row['id_id_medica']; 
		 $nombre=$row['nombre_medica']; 
	/*	 $precio=$row['pventa_medica']; */
		 $qtyp=$row['stock_medica'];
		}
	/*$da= $ba*$precio;	*/
	$ga= "1";	
		$count= $db2->prepare("SELECT * FROM payconcept WHERE idconcept_pay=:id_id AND user_id=:uid AND status='1'");
		$count->bindParam(':id_id', $id_id_medica);
		$count->bindParam(':uid', $uid);
		$count->execute();
		for($i=0; $row = $count->fetch(); $i++){ 
		 $qty=$row['cantidad_pay']; 
		}
if (!isset($qty)) {
$sql2 = "INSERT INTO payconcept (fecha_pay, idconcept_pay, concept_pay, /*debe_pay,*/ id_residente, reg_pay, cantidad_pay, status, user_id) VALUES (:a, :b, :c, /*:d,*/ :e, :f, :g, :h, :i)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$ca, ':b'=>$id_id_medica, ':c'=>$nombre,/* ':d'=>$da,*/ ':e'=>$rid, ':f'=>$ca, ':g'=>$ba, ':h'=>$ga, ':i'=>$uid));
if($sav) {
	$sql2 = "UPDATE medicamentos SET stock_medica=:qtyp-:ba WHERE id_id_medica=:id";
	$sav2 = $db2->prepare($sql2);
	$sav2->bindParam(':qtyp', $qtyp);
	$sav2->bindParam(':ba', $ba);
	$sav2->bindParam(':id', $id_id_medica);
	$sav2->execute();
      require_once ("../pages/finder.php"); 
  }else{
      echo "<span class='disponible'> Error desconocido, Favor de reportar la falla a soporte técnico!</span>";
  }
}
else{
			$nqt=$qty+$ba;
			$count2= $db2->prepare("UPDATE payconcept SET cantidad_pay=:nqt/*, debe_pay=:nqt*:precio*/ WHERE idconcept_pay=:id_id AND user_id=:uid AND status='1'");
			$count2->bindParam(':nqt', $nqt);
			/*$count2->bindParam(':precio', $precio);*/
			$count2->bindParam(':id_id', $id_id_medica);
			$count2->bindParam(':uid', $uid);
			$count2->execute();	
	if($count2) {
		$sql2 = "UPDATE medicamentos SET stock_medica=:qtyp-:ba WHERE id_id_medica=:id";
		$sav2 = $db2->prepare($sql2);
		$sav2->bindParam(':qtyp', $qtyp);
		$sav2->bindParam(':ba', $ba);
		$sav2->bindParam(':id', $id_id_medica);
		$sav2->execute();
      require_once ("../pages/finder.php"); 
  }else{
      echo "<span class='disponible'> Error desconocido, Favor de reportar la falla a soporte técnico!</span>";
  }
}
?>