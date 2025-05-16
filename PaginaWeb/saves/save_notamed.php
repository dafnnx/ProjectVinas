<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['id_residente'];
	$ba= $_POST['id_usuario'];
	$ca= $_POST['motivo_notamed'];
	$da= $_POST['explo_notamed'];
	$ea= $_POST['ta_notamed'];
	$fa= $_POST['fc_notamed'];
	$ga= $_POST['fr_notamed'];
	$ha= $_POST['sat_notamed'];
	$ia= $_POST['temp_notamed'];
	$ja= $_POST['gli_notamed'];
	$ka= $_POST['fec_notamed'];
	$la= $_POST['notmed_notamed'];
	$ma= $_POST['trata_notamed'];
	$na= date('Y-m-d H:i:s');
	$oa= $_POST['id_medic'];
		$sql2 = "INSERT INTO nota_medica (id_residente, id_usuario, motivo_notamed, explo_notamed, ta_notamed, fc_notamed, fr_notamed, sat_notamed, temp_notamed, gli_notamed, fec_notamed, notmed_notamed, trata_notamed, feccap_notamed, id_medic) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n, :o)";
		$sav = $db2->prepare($sql2);
		$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':k'=>$ka,':l'=>$la,':m'=>$ma,':n'=>$na,':o'=>$oa));
if($sav) {
      echo "<span class='uso'> Correcto.</span>";
  }else{
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  } ;