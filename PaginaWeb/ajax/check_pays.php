<?php 
  require_once ("../cn/connect2.php");
  $idp= $_POST['idp'];

    $count_query= $db2->prepare("SELECT sale_id AS numrows FROM payconcept WHERE id_pay=:idp");
    $count_query->bindParam(':idp', $idp);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){    $numrows = $row['numrows'];  }

      echo $numrows;
    
?>