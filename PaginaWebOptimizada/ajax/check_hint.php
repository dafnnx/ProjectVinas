<?php 
  require_once ("../cn/connect2.php");
  $rid= $_POST['rid'];
  $count_query= $db2->prepare("SELECT tarifa_residente AS hint FROM tarifas WHERE id_tarifa=(SELECT MAX(id_tarifa) AS id_tar FROM tarifas WHERE id_residente=:id AND tarifa_residente>'0')");
    $count_query->bindParam(':id', $rid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $hint = $row['hint'];}
  echo $hint;
?>