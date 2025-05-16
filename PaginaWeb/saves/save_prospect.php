<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['curp_prospecto'];
	$ba= $_POST['nss_prospecto'];
	$ca= $_POST['nombre_prospecto'];
	$da= $_POST['tipologia_prospecto'];	
	$ea= $_POST['ecivil_prospecto'];
	$fa= $_POST['origen_prospecto'];
	$ga= $_POST['sexo_prospecto'];
	$ha= $_POST['edad_prospecto'];
	$ia= $_POST['fnac_prospecto'];
	$ja= $_POST['depen_prospecto'];
	$ka= $_POST['user_id'];
	$la= "1";
	$ma= $_POST['area_prospecto'];	
	$na= date('Y-m-d');
	$oa= $_POST['seguimiento_prospecto'];	
	$pa= $_POST['tarifa_prospecto'];
	$qa= $_POST['camina_prospecto'];
	$ra= $_POST['come_prospecto'];
	$sa= $_POST['bana_prospecto'];
	$ta= $_POST['viste_prospecto'];
	$ua= $_POST['panales_prospecto'];
	$va= $_POST['observa_prospecto'];
	$wa= $_POST['medio_prospecto'];	
$sql2 = "INSERT INTO prospectos (curp_prospecto, nss_prospecto, nombre_prospecto, tipologia_prospecto, ecivil_prospecto, origen_prospecto, sexo_prospecto, edad_prospecto, fnac_prospecto, depen_prospecto,  user_id, status_prospecto, area_prospecto, fecha_prospecto, seguimiento_prospecto, tarifa_prospecto, camina_prospecto, come_prospecto, bana_prospecto, viste_prospecto, panales_prospecto, observa_prospecto, medio_prospecto) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n, :o, :p, :q, :r, :s, :t, :u, :v, :w)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':k'=>$ka,':l'=>$la,':m'=>$ma,':n'=>$na,':o'=>$oa,':p'=>$pa,':q'=>$qa,':r'=>$ra,':s'=>$sa,':t'=>$ta,':u'=>$ua,':v'=>$va,':w'=>$wa));
if($sav) {
	$rid = $db2->lastInsertId();
	echo $rid;
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>