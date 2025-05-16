<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['id_residente'];
	$ba= $_POST['id_usuario'];
	$ca= $_POST['id_notamed'];
	$da= $_POST['motivo_segnotamed'];
	$ea= $_POST['explo_segnotamed'];
	$fa= $_POST['ta_segnotamed'];
	$ga= $_POST['fc_segnotamed'];
	$ha= $_POST['fr_segnotamed'];
	$ia= $_POST['sat_segnotamed'];
	$ja= $_POST['temp_segnotamed'];
	$ka= $_POST['gli_segnotamed'];
	$la= $_POST['fec_segnotamed'];
	$ma= $_POST['notmed_segnotamed'];
	$na= $_POST['trata_segnotamed'];
	$oa= date('Y-m-d H:i:s');
	$pa= $_POST['id_segmedic'];
		$sql2 = "INSERT INTO seg_notamedica (id_residente, id_usuario, id_notamed, motivo_segnotamed, explo_segnotamed, ta_segnotamed, fc_segnotamed, fr_segnotamed, sat_segnotamed, temp_segnotamed, gli_segnotamed, fec_segnotamed, notmed_segnotamed, trata_segnotamed, feccap_segnotamed, id_segmedic) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n, :o, :p)";
		$sav = $db2->prepare($sql2);
		$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':k'=>$ka,':l'=>$la,':m'=>$ma,':n'=>$na,':o'=>$oa,':p'=>$pa));
if($sav) {
      echo "<span class='uso'> Correcto.</span>";
  }else{
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  } ;