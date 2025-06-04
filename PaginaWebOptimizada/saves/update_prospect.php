<?php
require_once ("../cn/connect2.php");
	$aa= $_POST['id_prospecto'];
    $ba= $_POST['curp_prospecto'];
    $ca= $_POST['nss_prospecto'];
    $da= $_POST['nombre_prospecto'];
    $ea= $_POST['tipologia_prospecto'];
    $fa= $_POST['ecivil_prospecto'];
    $ga= $_POST['origen_prospecto'];
    $ha= $_POST['sexo_prospecto'];
    $ia= $_POST['edad_prospecto'];
    $ja= $_POST['fnac_prospecto'];
    $ka= $_POST['depen_prospecto'];
    $la= $_POST['area_prospecto'];
    $ma= $_POST['seguimiento_prospecto']; 
    $na= $_POST['tarifa_prospecto']; 
    $oa= $_POST['camina_prospecto']; 
    $pa= $_POST['come_prospecto']; 
    $qa= $_POST['bana_prospecto']; 
    $ra= $_POST['viste_prospecto']; 
    $sa= $_POST['panales_prospecto']; 
    $ta= $_POST['observa_prospecto']; 
    $ua= $_POST['medio_prospecto'];  
$sql2 = "UPDATE prospectos SET curp_prospecto='$ba', nss_prospecto='$ca', nombre_prospecto='$da', tipologia_prospecto='$ea', ecivil_prospecto='$fa',  origen_prospecto='$ga', sexo_prospecto='$ha', edad_prospecto='$ia', fnac_prospecto='$ja', depen_prospecto='$ka', area_prospecto='$la', seguimiento_prospecto='$ma', tarifa_prospecto='$na', camina_prospecto='$oa', come_prospecto='$pa', bana_prospecto='$qa', viste_prospecto='$ra', panales_prospecto='$sa', observa_prospecto='$ta', medio_prospecto='$ua' WHERE id_prospecto=$aa";
$sav = $db2->prepare($sql2);
$sav->execute();
if($sav) {
	echo "<span class='disponible'> Correcto.</span>";
  } else {      echo "<span class='disponible'> Error desconocido, intenta nuevamente.</span>";	  }	?>