<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['resic_treat'];
	$ba= $_POST['fecha_ini'];
	$ca= $_POST['fecha_fin'];
	$da= $_POST['med_tratamiento'];
	$ea= $_POST['via_medicamento'];
	$fa= $_POST['unidad_medicamento'];
	if(isset($_POST["days"]))
		{	$ga=implode(",",$_POST["days"]);  }
	$ha= $_POST['variante_tratamiento'];
	$ia= $_POST['total_tratamiento'];
	$ja= $_POST['dia_tratamiento'];
	$ka= $_POST['siet_tratamiento'];
	$la= $_POST['och_tratamiento'];
	$ma= $_POST['trce_tratamiento'];
	$na= $_POST['dieco_tratamiento'];
	$oa= $_POST['vtuno_tratamiento'];
	$pa= $_POST['observa_tratamiento'];
	$qa= $_POST['patolo_tratamiento'];
	$ra= $_POST['tipomed_tratamiento'];
	$sa= $_POST['pauta_tratamiento'];
	$ta= $_POST['user_id'];
	$ua= "1";
	$va= $_POST['consul_tratamiento'];
$sql2 = "INSERT INTO tratamientos (id_residente, fecha_ini, fecha_fin, med_tratamiento, via_medicamento, unidad_medicamento, semana_tratamiento, variante_tratamiento, total_tratamiento, dia_tratamiento, siet_tratamiento, och_tratamiento, trce_tratamiento, dieco_tratamiento, vtuno_tratamiento, observa_tratamiento, patolo_tratamiento, tipom_tratamiento, pauta_tratamiento, user_id, status_tratamiento, consul_tratamiento) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n, :o, :p, :q, :r, :s, :t, :u, :v)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':k'=>$ka,':l'=>$la,':m'=>$ma,':n'=>$na,':o'=>$oa,':p'=>$pa,':q'=>$qa,':r'=>$ra,':s'=>$sa,':t'=>$ta,':u'=>$ua,':v'=>$va));
if($sav)
 { echo "$aa"; } 
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?> 