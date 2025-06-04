<?php 
  require_once ("../cn/connect2.php");
  $rid= $_POST['rid'];
  $mes= $_POST['mes'];
    $query=$db2->prepare("SELECT SUM(abono_tarifa) AS abonos FROM tarifas WHERE id_residente=:id AND fecha_tarifa=:mes");
    $query->bindParam(':id', $rid);
    $query->bindParam(':mes', $mes);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){    $abonos= $row['abonos'];    }
  echo $abonos;
?>