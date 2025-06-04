<?php
require_once ("../cn/connect2.php");
	$ba= $_POST['nmed'];
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM medicamentos WHERE nombre_medica=:ba");
    $count_query->bindParam(':ba', $ba);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
if($count_query)
 { echo $numrows; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>