<?php 
  require_once ("../cn/connect2.php");
  $sid= $_POST['sid'];

    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM payconcept WHERE sale_id=:sid");
    $count_query->bindParam(':sid', $sid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){    $numrows = $row['numrows'];  }

      echo $numrows;
    
?>