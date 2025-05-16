<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['super_fecha'];
	if(isset($_POST["hours"]))
		{	$ba=implode(",",$_POST["hours"]);  }
	$ca= $_POST['super_ids'];

$test= array('69', '64', '68');


		$count_query= $db2->prepare("SELECT nombre_residente AS nomresi FROM residentes WHERE id_residente=$test");
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$nomresi = $row['nomresi'];}

var_dump($nomresi);
?> 