<?php
require_once ("../cn/connect2.php");
	$ba= $_POST['mid'];
	$ca= $_POST['barras_medica'];
	$da= $_POST['nombre_medica'];
	$ea= $_POST['sani_medica'];	
	$fa= $_POST['unidosis_medica'];
	$ga= $_POST['cabedisp_medica'];
	$ha= $_POST['frio_medica'];
	$ia= $_POST['observa_medica'];	
	$ja= $_POST['envase_medica'];
	$ka= $_POST['unidad_medica'];
	$la= $_POST['presenta_medica'];
	$ma= $_POST['qtyind_medica'];
	$na= $_POST['stock_medica'];
	$oa= $_POST['pcompra_medica'];
	$pa= $_POST['pventa_medica'];
$sql2 = "UPDATE medicamentos SET barras_medica='$ca', nombre_medica='$da', sani_medica='$ea', unidosis_medica='$fa', cabedisp_medica='$ga', frio_medica='$ha', observa_medica='$ia', envase_medica='$ja', unidad_medica='$ka', presenta_medica='$la', qtyind_medica='$ma', stock_medica='$na', pcompra_medica='$oa', pventa_medica='$pa' WHERE id_medica=$ba";
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {
      echo "<span class='uso'> Producto editado correctamente.</span>";
  }else{
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  } ?>
