<?php
require_once ("../cn/connect2.php");
require_once("../libraries/password_compatibility_library.php");
$idr = $_POST['idr'];
$usr = $_POST['usr'];
$pas = $_POST['pass'];
$pass = password_hash($pas, PASSWORD_DEFAULT);
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM guest_users WHERE id_residente=:idr");
		$count_query->bindParam(':idr', $idr);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){		$numrows = $row['numrows'];		}
if ($numrows) {	
	$sql2 = "UPDATE guest_users SET user_name='$usr', user_password_hash='$pass' WHERE id_residente='$idr'";
	$sav = $db2->prepare($sql2);
	$sav->execute();
} else {
$sql = "INSERT INTO guest_users (id_residente, user_name, user_password_hash) VALUES (:a,:b,:c)";
$q = $db2->prepare($sql);
$q->execute(array(':a'=>$idr,':b'=>$usr,':c'=>$pass));  }

?>