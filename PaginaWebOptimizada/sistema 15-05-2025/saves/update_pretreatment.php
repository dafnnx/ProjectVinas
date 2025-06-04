<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['idr_up'];
	$ab= $_POST['idt_up'];
	$ba= $_POST['fecha_iniup'];
	$ca= $_POST['fecha_finup'];
	$da= $_POST['med_tratamientoup'];
	$ea= $_POST['via_medicamentoup'];
	$fa= $_POST['unidad_medicamentoup'];
	if(isset($_POST["daysupup"]))
		{	$ga=implode(",",$_POST["daysupup"]);  }
	$ha= $_POST['variante_tratamientoup'];
	$ia= $_POST['total_tratamientoup'];
	$ja= $_POST['dia_tratamientoup'];
	$ka= $_POST['siet_tratamientoup'];
	$la= $_POST['och_tratamientoup'];
	$ma= $_POST['trce_tratamientoup'];
	$na= $_POST['dieco_tratamientoup'];
	$oa= $_POST['vtuno_tratamientoup'];
	$pa= $_POST['observa_tratamientoup'];
	$qa= $_POST['patolo_tratamientoup'];
	$ra= $_POST['tipomed_tratamientoup'];
	$sa= $_POST['pauta_tratamientoup'];
	$ta= "usuario";
	$ua= "1";
	$va= $_POST['consul_tratamientoup'];
$sql2 = "INSERT INTO tratamientos (id_residente, fecha_ini, fecha_fin, med_tratamiento, via_medicamento, unidad_medicamento, semana_tratamiento, variante_tratamiento, total_tratamiento, dia_tratamiento, siet_tratamiento, och_tratamiento, trce_tratamiento, dieco_tratamiento, vtuno_tratamiento, observa_tratamiento, patolo_tratamiento, tipom_tratamiento, pauta_tratamiento, user_id, status_tratamiento, consul_tratamiento) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n, :o, :p, :q, :r, :s, :t, :u, :v)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':k'=>$ka,':l'=>$la,':m'=>$ma,':n'=>$na,':o'=>$oa,':p'=>$pa,':q'=>$qa,':r'=>$ra,':s'=>$sa,':t'=>$ta,':u'=>$ua,':v'=>$va));
if($sav)
 { 
			$sql3 = "UPDATE tratamientos SET status_tratamiento=2 WHERE id_tratamiento=$ab";
			$sav2 = $db2->prepare($sql3);
			$sav2->execute();
			if($sav2) { echo "<span class='disponible'> Correcto</span>";  }  
			else   {   echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }
 } 
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?> 