<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['theres'];
    $count_query= $db2->prepare("SELECT count(*) AS numrows FROM residentes WHERE id_residente LIKE :aa");
    $count_query->bindParam(':aa', $aa);
    $count_query->execute();
    for($i=0; $row = $count_query->fetch(); $i++){
    $numrows = $row['numrows'];}
echo $numrows;
?>