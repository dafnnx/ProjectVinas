<?php
require_once ("../cn/connect2.php");
      $uid= $_POST['uid'];
      $tst = $db2->prepare("SELECT MAX(id_medica) as idm FROM medicamentos ORDER BY id_medica DESC LIMIT 1");
      $tst->execute();
for($i=0; $row = $tst->fetch(); $i++){
            $idm = $row['idm'];}
if ($idm==NULL){ $idm=0; }
else{}
      $nidm= $idm+1;
      $aa= "Nuevo med ".$nidm;
	$ba= $uid;	
$sql2 = "INSERT INTO medicamentos (nombre_medica, user_id) VALUES (:a, :b)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba));
if($sav)
 { echo $nidm.",".$aa; }
else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";  }
?>