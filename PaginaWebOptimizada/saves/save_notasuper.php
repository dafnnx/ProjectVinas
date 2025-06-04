<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['turno_notasuper'];
	$ba= $_POST['evens_turno_notasuper'];
	$ca= $_POST['fec_notasuper'];
	$da= $_POST['uid_note'];	

		$count_query= $db2->prepare("SELECT id_personal AS idper FROM users WHERE user_id=:da");
		$count_query->bindParam(':da', $da);
		$count_query->execute();
		for($i=0; $row = $count_query->fetch(); $i++){
		$idper = $row['idper'];}

		$sql2 = "INSERT INTO nota_supervision (turno_notasuper, obs_notasuper, fecha_notasuper, id_personal) VALUES (?, ?, ?, ?)";
		$sav = $db2->prepare($sql2);
		$sav->bindValue(1, $aa, PDO::PARAM_STR);
    $sav->bindValue(2, $ba, PDO::PARAM_STR);
    $sav->bindValue(3, $ca, PDO::PARAM_STR);
    $sav->bindValue(4, $idper, PDO::PARAM_INT);
		$sav->execute();
if($sav) {
      echo "<span class='uso'> Correcto.</span>";
  }else{
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  } ;