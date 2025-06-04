<?php
	include('../cn/connect2.php');
	$sid=$_POST['sid'];

	$query = $db2->prepare("DELETE FROM presales WHERE presale_id=:sid");
	$query->bindParam(':sid', $sid);
	$query->execute();
	if ($query) 	{echo "<span class='disponible'>Correcto</span>"; }
	else 		{	echo 'Error: ' . $e->getMessage();			}
?>