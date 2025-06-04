<?php 
  require_once ("../cn/connect2.php");
  $today= $_POST['today'];
    $query=$db2->prepare("SELECT num_days AS numd FROM dayscant WHERE fecha_days=:td");
    $query->bindParam(':td', $today);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){    echo $numd= $row['numd'];     };
?>