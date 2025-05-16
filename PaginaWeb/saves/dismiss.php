<?php
	include('../cn/connect2.php');
	$uid=$_POST['uid'];

	$quer= $db2->prepare("SELECT * FROM presales WHERE user_id=:uid AND status='1'");
	$quer->bindParam(':uid', $uid);
	$quer->execute();
	for($i=0; $row = $quer->fetch(); $i++){ 
		 $idp=$row['id_producto'];
		 $qty=$row['qty'];

$sql2 = "UPDATE productos SET qty_producto=qty_producto+$qty WHERE id_producto=$idp";
$sav = $db2->prepare($sql2);
$sav->execute();
		}
if ($sav) {
	$query= $db2->prepare("DELETE FROM presales WHERE user_id=:uid AND status='1'");
	$query->bindParam(':uid', $uid);
	$query->execute();
	if ($query) 	{	 echo 'Carrito Vacio '; 	}
	else 		{	echo 'Error: ' . $e->getMessage();			}
}
?>