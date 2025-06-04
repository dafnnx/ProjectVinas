<?php
	require_once ("../cn/connect2.php");
$rid= $_POST['rid'];
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM payconcept WHERE id_residente=:rid AND status=2");
    $count_query->bindParam(':rid', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}	
if($count_query) {
	echo $numrows;	
} else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>