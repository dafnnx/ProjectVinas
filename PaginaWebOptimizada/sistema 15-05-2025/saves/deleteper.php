<?php
	include('../cn/connect2.php');
	$id=$_POST['id_id'];
	$table=$_POST['table'];
	$wich=$_POST['wich'];
	$result = $db2->prepare("DELETE FROM $table WHERE $wich= $id");
	$result->execute();	
	if ($result) {
		$result2 = $db2->prepare("DELETE FROM users WHERE id_personal= $id");
		$result2->execute();
	} else{
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>

