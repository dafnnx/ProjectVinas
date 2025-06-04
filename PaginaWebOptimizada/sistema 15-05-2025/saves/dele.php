<?php
	include('../cn/connect2.php');
	$id=$_POST['id_id'];
	$result = $db2->prepare("DELETE FROM payconcept WHERE id_pay= $id");
	$result->execute();
	try 
		{ $result; }
catch (PDOException $e) 
{
    echo 'Error: ' . $e->getMessage();
    exit();
}
?>

