<?php
require_once ("../cn/connect2.php");
$cp= $_POST['concept_pay'];
$icp= $_POST['invconcept_pay'];
$app= $_POST['aporta_pay'];	
$fpa= $_POST['fpago_pay'];	
$sta= "2";	
if (isset($icp)) {
	$iicp=(explode(',',$icp));
}	
if ($cp && !$icp) {
	$id= $_POST['id_residente'];
	$ba= $_POST['fecha_pay'];
	$ca= $_POST['concept_pay'];
	$da= $_POST['debe_pay'];	
	$ea= $_POST['aporta_pay'];
	$fa= date('Y-m-d');
	$ga= $_POST['persona_pay'];
	$ha= $_POST['cantidad_pay'];
$sql2 = "INSERT INTO payconcept (fecha_pay, concept_pay, debe_pay, aporta_pay, id_residente, reg_pay, persona_pay, cantidad_pay, status, fpago_pay) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$ba,':b'=>$ca,':c'=>$da,':d'=>$ea,':e'=>$id,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$sta,':j'=>$fpa));
if($sav) {
	echo "<span class='disponible'> Correcto. </span>";	
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	
}
elseif (!$cp && $icp) {
	$id= $_POST['id_residente'];
	$ba= $_POST['fecha_pay'];
	$ca= $iicp[0];
	$da= $_POST['debe_pay'];	
	$ea= $_POST['aporta_pay'];
	$fa= date('Y-m-d');
	$ga= $_POST['persona_pay'];
	$ha= $_POST['cantidad_pay'];
$sql2 = "INSERT INTO payconcept (fecha_pay, concept_pay, debe_pay, aporta_pay, id_residente, reg_pay, persona_pay, cantidad_pay, status, fpago_pay) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j)";
$sav = $db2->prepare($sql2);
$sav->execute(array(':a'=>$ba,':b'=>$ca,':c'=>$da,':d'=>$ea,':e'=>$id,':f'=>$fa,':g'=>$ga,':h'=>$ha,':i'=>$sta,':j'=>$fpa));
if($sav) {
	echo "<span class='disponible'> Correcto. </span>";	
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	
}
else{}	?>
