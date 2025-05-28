
<?php
require_once ("../cn/connect2.php");
$amn = $_POST['amn'];
$uid = $_POST['uid'];
$rid = $_POST['rid'];
$sta = 3;
$dat = date('Y-m-d');

	$result = $db2->prepare("SELECT nombre_residente AS nres FROM residentes WHERE id_residente=:rid");
	$result->bindParam(':rid', $rid);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){ 			$nres= $row['nres'];	 }

$sql = "INSERT INTO presales (amount, id_usuario, id_residente, nombre_residente, status, fecha) VALUES (:a, :b, :c, :d, :e, :f)";
$q = $db2->prepare($sql);
$q->execute(array(':a'=>$amn,':b'=>$uid,':c'=>$rid,':d'=>$nres,':e'=>$sta,':f'=>$dat));
$id = $db2->lastInsertId();
if($sql) {
	$sql2 = "UPDATE payconcept SET sale_id='$id', status=3 WHERE user_id=$uid AND status=1";
	$sav = $db2->prepare($sql2);
	$sav->execute();
  }else{
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>