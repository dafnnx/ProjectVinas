<?php
$sql2 = "INSERT INTO repos (id_residente, sub_repo) VALUES (:a, :b)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$idr,':b'=>$resapo));
?>