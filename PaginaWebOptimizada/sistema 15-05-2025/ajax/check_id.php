<?php
$idm= $_POST['idm'];
require_once ("../cn/connect2.php");
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM medicamentos WHERE id_medica=:id");
    $count_query->bindParam(':id', $idm);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){   $numrows = $row['numrows'];     }


      echo $numrows;
?>