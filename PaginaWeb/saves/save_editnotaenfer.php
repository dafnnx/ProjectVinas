<?php
require_once ("../cn/connect2.php");	
	$aa= $_POST['ta_notaenfer_e'];
	$ba= $_POST['fc_notaenfer_e'];
	$ca= $_POST['fr_notaenfer_e'];
	$da= $_POST['sat_notaenfer_e'];
	$ea= $_POST['temp_notaenfer_e'];
	$fa= $_POST['gli_notaenfer_e'];
	$ga= $_POST['percen_ing_notaenfer_e'];
	$ha= $_POST['cant_liq_notaenfer_e'];
	$ia= $_POST['no_mic_notaenfer_e'];
	$ja= $_POST['no_evac_notaenfer_e'];
	$ka= $_POST['no_panal_notaenfer_e'];
	$la= $_POST['visita_notaenfer_e'];
	$ma= $_POST['caida_notaenfer_e'];
	$na= $_POST['deam_notaenfer_e'];
	$oa= $_POST['bano_notaenfer_e'];
	$pa= $_POST['bucal_notaenfer_e'];
	$qa= $_POST['terap_notaenfer_e'];
	$ra= $_POST['evens_turno_notaenfer_e'];
	$sa= $_POST['turno_notaenfer_e'];
	$ta= $_POST['idnote_e'];
		$sql2 = "UPDATE nota_enfermeria SET ta_notaenfer=?, fc_notaenfer=?, fr_notaenfer=?, sat_notaenfer=?, temp_notaenfer=?, gli_notaenfer=?, percen_ing_notaenfer=?, cant_liq_notaenfer=?, no_mic_notaenfer=?, no_evac_notaenfer=?, no_panal_notaenfer=? , visita_notaenfer=? , caida_notaenfer=?, deam_notaenfer=?, bano_notaenfer=?, bucal_notaenfer=?, terap_notaenfer=?, evens_turno_notaenfer=?, turno_notaenfer=? WHERE id_notaenfer=?";
		$sav = $db2->prepare($sql2);
		$sav->bindValue(1, $aa, PDO::PARAM_STR);
    $sav->bindValue(2, $ba, PDO::PARAM_STR);
    $sav->bindValue(3, $ca, PDO::PARAM_STR);
    $sav->bindValue(4, $da, PDO::PARAM_STR);
    $sav->bindValue(5, $ea, PDO::PARAM_STR);
    $sav->bindValue(6, $fa, PDO::PARAM_STR);
    $sav->bindValue(7, $ga, PDO::PARAM_STR);
    $sav->bindValue(8, $ha, PDO::PARAM_STR);
    $sav->bindValue(9, $ia, PDO::PARAM_STR);
    $sav->bindValue(10, $ja, PDO::PARAM_STR);
    $sav->bindValue(11, $ka, PDO::PARAM_STR);
    $sav->bindValue(12, $la, PDO::PARAM_STR);
    $sav->bindValue(13, $ma, PDO::PARAM_STR);
    $sav->bindValue(14, $na, PDO::PARAM_STR);
    $sav->bindValue(15, $oa, PDO::PARAM_STR);
    $sav->bindValue(16, $pa, PDO::PARAM_STR);
    $sav->bindValue(17, $qa, PDO::PARAM_STR);
    $sav->bindValue(18, $ra, PDO::PARAM_STR);
    $sav->bindValue(19, $sa, PDO::PARAM_STR);
    $sav->bindValue(20, $ta, PDO::PARAM_INT);
		$sav->execute();
if($sav) {
      echo "<span class='uso'> Correcto.</span>";
  }else{
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  } ;