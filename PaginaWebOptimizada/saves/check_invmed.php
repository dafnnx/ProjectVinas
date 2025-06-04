<?php
require_once ("../cn/connect2.php");
	  $aa= $_POST['rid'];
      $ba= $_POST['id'];
      
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM inventarios WHERE id_residente=:aa AND medicamento_inv=:ba");
    $count_query->bindParam(':aa', $aa);
    $count_query->bindParam(':ba', $ba);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){    $numrows = $row['numrows'];       }
        echo $numrows;