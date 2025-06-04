<?php
 $rid =$_POST['rid'];
	require_once ("../cn/connect2.php"); 	
		$count_query= $db2->prepare("SELECT count(*) AS numrows FROM precontactos WHERE id_prospecto=:id");
		$count_query->bindParam(':id', $rid);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$numrows = $row['numrows'];	 }
echo $numrows; 
?>