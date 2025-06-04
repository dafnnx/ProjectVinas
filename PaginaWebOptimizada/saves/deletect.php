<?php
	include('../cn/connect2.php');
	$id=$_POST['id_id'];
	$table=$_POST['table'];
	$wich=$_POST['wich'];
	$result = $db2->prepare("DELETE FROM $table WHERE $wich= $id");
	$result->execute();
	try 
		{ $result; }
catch (PDOException $e) 
{
    echo 'Error: ' . $e->getMessage();
    exit();
}
?>

