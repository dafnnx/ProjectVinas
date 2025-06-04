<?php 
require_once ("../cn/connect2.php");
    $uid = $_POST['uid'];
    $rid = $_POST['rid'];

	$sql2 = "UPDATE payconcept SET id_residente='$rid' WHERE user_id=$uid AND status=1";
	$sav = $db2->prepare($sql2);
	$sav->execute();
?>