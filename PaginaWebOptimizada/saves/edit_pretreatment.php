<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['idt_up'];
	$ba= $_POST['fecha_inied'];
	$ca= $_POST['fecha_fined'];
	$da= $_POST['med_tratamientoed'];
	$ea= $_POST['via_medicamentoed'];
	$fa= $_POST['unidad_medicamentoed'];
	if(isset($_POST["daysup"]))
		{	$ga=implode(",",$_POST["daysup"]);  }
	$ha= $_POST['variante_tratamientoed'];
	$ia= $_POST['total_tratamientoed'];
	$ja= $_POST['dia_tratamientoed'];
	$ka= $_POST['siet_tratamientoed'];
	$la= $_POST['och_tratamientoed'];
	$ma= $_POST['trce_tratamientoed'];
	$na= $_POST['dieco_tratamientoed'];
	$oa= $_POST['vtuno_tratamientoed'];
	$pa= $_POST['observa_tratamientoed'];
	$qa= $_POST['patolo_tratamientoed'];
	$ra= $_POST['tipomed_tratamientoed'];
	$sa= $_POST['pauta_tratamientoed'];
	$ta= $_POST['consul_tratamientoed'];

$sql2 = "UPDATE tratamientos SET fecha_ini='$ba', fecha_fin='$ca', med_tratamiento='$da', via_medicamento='$ea', unidad_medicamento='$fa', semana_tratamiento='$ga', variante_tratamiento='$ha', total_tratamiento='$ia', dia_tratamiento='$ja', siet_tratamiento='$ka', och_tratamiento='$la', trce_tratamiento='$ma', dieco_tratamiento='$na', vtuno_tratamiento='$oa', observa_tratamiento='$pa', patolo_tratamiento='$qa', tipom_tratamiento='$ra', pauta_tratamiento='$sa', consul_tratamiento='$ta' WHERE id_tratamiento=$aa";
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav)
 { echo "Correcto"; } 
else {
      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";
  }
?> 