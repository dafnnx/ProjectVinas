<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['tosave'];
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM atenciones WHERE nombre_atencion=:aa");
    $count_query->bindParam(':aa', $aa);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
if($count_query)
 { echo $numrows; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>