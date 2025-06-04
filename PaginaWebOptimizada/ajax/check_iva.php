<?php 
  require_once ("../cn/connect2.php");
  $idm= $_POST['idm'];

    $count_query= $db2->prepare("SELECT iva_medica AS ivamed FROM medicamentos WHERE id_id_medica=:idm");
    $count_query->bindParam(':idm', $idm);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){    $ivamed = $row['ivamed'];  }

  if ($ivamed) {
    $c_query= $db2->prepare("SELECT percent_iiva AS periiva FROM iiva WHERE id_iva=:ivamed");
    $c_query->bindParam(':ivamed', $ivamed);
    $c_query->execute();
    for($i=0; $row = $c_query->fetch(); $i++){    $periiva = $row['periiva'];  }
      echo $periiva;
  }
    
?>