<?php 
  require_once ("../cn/connect2.php");
  $aid= $_POST['ida'];

    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM ropa_residente WHERE id_armario=:id");
    $count_query->bindParam(':id', $aid);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];
echo $numrows;
  }
    
?>