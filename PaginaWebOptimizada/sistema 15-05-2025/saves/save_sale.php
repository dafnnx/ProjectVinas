<?php
require_once ("../cn/connect2.php");
$sid = $_POST['sid'];
$uid = $_POST['uid'];
$idr = $_POST['idr'];
$amn = 0;
$sta = 2;
$dat = date('Y-m-d');
$sql = "INSERT INTO sales (sale_id, amount, id_usuario, id_residente, status, fecha) VALUES (:a,:b,:c,:d,:e,:f)";
$q = $db2->prepare($sql);
$q->execute(array(':a'=>$sid,':b'=>$amn,':c'=>$uid,':d'=>$idr,':e'=>$sta,':f'=>$dat));
if($sql) {
	$sql2 = "UPDATE payconcept SET status=2 WHERE sale_id='$sid' AND status=3";
	$sav = $db2->prepare($sql2);
	$sav->execute();

	$sql2 = "UPDATE presales SET status='$sta' WHERE presale_id=$sid ";
	$sav2 = $db2->prepare($sql2);
	$sav2->execute();
  }else{
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>