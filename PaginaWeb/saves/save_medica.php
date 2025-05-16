<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['mid'];
	$ba= $_POST['barras_medica'];
if (is_null($ba) or $ba=="") {	$ba="Sin codigo";	}
	$ca= $_POST['nombre_medica'];
	$da= $_POST['sani_medica'];	
	$ea= $_POST['unidosis_medica'];
	$fa= $_POST['cabedisp_medica'];
	$ga= $_POST['frio_medica'];
	$ha= $_POST['observa_medica'];	
	$ia= $_POST['envase_medica'];
	$ja= $_POST['unidad_medica'];
	$ka= $_POST['presenta_medica'];
	$la= $_POST['qtyind_medica'];
	$ma= $_POST['stock_medica'];
	$na= $_POST['clave_sat'];
	$oa= $_POST['unidad_sat'];
	$pa= $_POST['cve_sae'];
	$qa= $_POST['iva_medica'];
$sql2 = "INSERT INTO medicamentos (id_medica, barras_medica, nombre_medica, sani_medica, unidosis_medica, cabedisp_medica, frio_medica, observa_medica, envase_medica, unidad_medica, presenta_medica, qtyind_medica, stock_medica, clave_sat, unidad_sat, cve_sae, iva_medica) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n, :o, :p, :q)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$aa,':b'=>$ba,':c'=>$ca,':d'=>$da,':e'=>$ea,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$ia,':j'=>$ja,':k'=>$ka,':l'=>$la,':m'=>$ma,':n'=>$na,':o'=>$oa,':p'=>$pa,':q'=>$qa));
if($sav) {
      echo "<span class='uso'> Producto editado correctamente.</span>";
  }else{
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  } ?>