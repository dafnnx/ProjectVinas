<?php
require_once ("../cn/connect2.php");
	$id= $_POST['mid'];
	$aa= $_POST['barras_medica'];
	$ba= $_POST['nombre_medica'];
	$ca= $_POST['sani_medica'];	
	$da= $_POST['unidosis_medica'];
	$ea= $_POST['cabedisp_medica'];
	$fa= $_POST['frio_medica'];
	$ga= $_POST['observa_medica'];	
	$ha= $_POST['envase_medica'];
	$ia= $_POST['unidad_medica'];
	$ja= $_POST['presenta_medica'];
	$ka= $_POST['qtyind_medica'];
	$la= $_POST['stock_medica'];
	$ma= $_POST['pcompra_medica'];
	$na= $_POST['pventa_medica'];
	$oa= $_POST['iva_medica'];
	$pa= $_POST['cve_sae'];
	$qa= $_POST['clave_sat'];
	$ra= $_POST['unidad_sat'];
		// NUEVO CAMPO PARA CONCENTRACIÓN
	$sa= $_POST['mililitros_medica'];
	// Si no se ingresa valor, asignar NULL
	if (is_null($sa) or $sa=="") { $sa = NULL; }
$sql2 = "UPDATE medicamentos SET barras_medica='$aa', nombre_medica='$ba', sani_medica='$ca', unidosis_medica='$da', cabedisp_medica='$ea', frio_medica='$fa', observa_medica='$ga', envase_medica='$ha', unidad_medica='$ia', presenta_medica='$ja', qtyind_medica='$ka', stock_medica='$la', pcompra_medica='$ma', pventa_medica='$na', iva_medica='$oa', cve_sae='$pa', clave_sat='$qa', unidad_sat='$ra' , mililitros_medica = '$sa' WHERE id_medica=$id";
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {
	 echo $id;
  }  else   {   echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>

