<?php
require_once ("../cn/connect2.php");
	$idr= $_POST['idr'];
      $ida= $_POST['ida'];
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM patologias_residente WHERE id_residente=:idr AND id_patologia=:ida");
    $count_query->bindParam(':idr', $idr);
    $count_query->bindParam(':ida', $ida);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
if($count_query)
 { echo $numrows; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?>