<?php
require_once ("../cn/connect2.php");
    $qy=$db2->prepare("SELECT MAX(id_tratamiento) AS id_trata FROM tratamientos");
    $qy->execute();
    for($i=0; $row = $qy->fetch(); $i++){
    $idt= $row['id_trata'];        }
    if (is_null($idt)) {
            $idt=1;
        } else { $idt= $idt+1; }  

      if($idt)
 { echo $idt; }
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }

?>