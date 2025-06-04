<?php 
  require_once ("../cn/connect2.php");
  $rid= $_POST['rid'];
  $mes= $_POST['mes'];

    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM paymont WHERE id_residente=:id AND mes_paym=:mes");
    $count_query->bindParam(':id', $rid);
    $count_query->bindParam(':mes', $mes);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
if ($numrows) {
    $query=$db2->prepare("SELECT SUM(cantidad_paym) AS abonos FROM paymont WHERE id_residente=:id AND mes_paym=:mes");
    $query->bindParam(':id', $rid);
    $query->bindParam(':mes', $mes);
    $query->execute();
    for($i=0; $row = $query->fetch(); $i++){    $abonos= $row['abonos'];    };
      if ($abonos) {        echo $abonos;      } 
      else { echo "N/E"; }
      

}
    
?>